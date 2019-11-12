<?php
declare(strict_types=1);

namespace App\Command;

use App\Model\InviaResortDataExtractor\InviaResortDataExtractor;
use App\Service\ResortMediaService;
use App\Service\ResortService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

class InviaResortCommand extends Command
{
    private const DESCRIPTION = 'Extract Resort Data';

    /** @var string  */
    protected static $defaultName = 'invia:resort:extract';

    /** @var SymfonyStyle */
    private $io;

    /** @var ResortService */
    private $resortService;

    /** @var ResortMediaService */
    private $resortMediaService;

    /** @var LoggerInterface */
    private $logger;

    /**
     * InviaResortCommand constructor.
     * @param ResortService $resortService
     * @param ResortMediaService $resortMediaService
     * @param LoggerInterface $logger
     */
    public function __construct(
        ResortService $resortService,
        ResortMediaService $resortMediaService,
        LoggerInterface $logger
    ) {
        parent::__construct();
        $this->resortService = $resortService;
        $this->resortMediaService = $resortMediaService;
        $this->logger = $logger;
    }


    /**
     * @return void
     */
    protected function configure(): void
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription(self::DESCRIPTION)
            ->setHelp(self::DESCRIPTION)
            ->addArgument('url', InputArgument::REQUIRED, 'Invia hotel detail url');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $this->io->title('Invia Resort Extractor');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $client = HttpClient::create();

        /** @var string $url */
        $url = $input->getArgument('url');

        try {
            $content = $client->request('GET', $url)->getContent();
            $inviaParser = new InviaResortDataExtractor($content);
            $resortCreateDto = $inviaParser->parseForResortData();
            $resortDto = $this->resortService->createResort($resortCreateDto);

            $picturesData = $inviaParser->parseForPictures();
            foreach ($picturesData as $index => $picture) {
                $this->resortMediaService->saveImage($resortDto->getId(), $picture);
            }
        } catch (\Throwable $e) {
            $this->logger->critical($e->getMessage(), $e->getTrace());
        }

        return 0;
    }
}
