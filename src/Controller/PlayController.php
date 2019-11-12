<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\InviaResortDataExtractor\InviaResortDataExtractor;
use App\Service\ResortMediaService;
use App\Service\ResortService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

class PlayController extends AbstractController
{
    /** @var ResortService */
    private $resortService;

    /** @var ResortMediaService */
    private $resortMediaService;

    /**
     * @param ResortService $resortService
     * @param ResortMediaService $resortMediaService
     */
    public function __construct(
        ResortService $resortService,
        ResortMediaService $resortMediaService
    ) {
        $this->resortService = $resortService;
        $this->resortMediaService = $resortMediaService;
    }

    /**
     * @Route("/play", name="play-controller")
     * @return Response
     */
    public function indexAction(): Response
    {
        $urls = [
            'https://hotel.invia.cz/egypt/safaga/magic-life-kalawy-imperial/',
            'https://hotel.invia.cz/kapverdske-ostrovy/ostrov-sal/oasis-atlantico-belorizonte/',
            'https://hotel.invia.cz/turecko/antalya/delphin-be-grand-ex-botanik-exclusiverixos-lares/',
            'https://hotel.invia.cz/egypt/hurghada/steigenberger-al-dau-beach-resort/',
            'https://hotel.invia.cz/kanarske-ostrovy/gran-canaria/gloria-palace-royal-hotel-spa/',
            'https://hotel.invia.cz/italie/paganella/alpenroyal-belvedere/',
            'https://hotel.invia.cz/turecko/kemer/barut-kemer/',
            'https://hotel.invia.cz/chorvatsko/baska-voda/bungalovy-neptun-klub/',
            'https://hotel.invia.cz/svet/-/msc-poesia/',
            'https://hotel.invia.cz/svet/-/msc-opera/',
            'https://hotel.invia.cz/svet/-/msc-magnifica/'
        ];

        $resortDtos = [];

        $client = HttpClient::create();

        foreach ($urls as $url) {
            try {
                $content = $client->request('GET', $url)->getContent();
                $inviaParser = new InviaResortDataExtractor($content);
                $resortCreateDto = $inviaParser->parseForResortData();

                $resortDtos[] = $resortDto = $this->resortService->createResort($resortCreateDto);

                $picturesData = $inviaParser->parseForPictures();
                foreach ($picturesData as $index => $picture) {
                    $this->resortMediaService->saveImage($resortDto->getId(), $picture);
                }
            } catch (Throwable $e) {
            }
        }

        return $this->render(
            'play.html.twig',
            [
                'resortCount' => count($resortDtos)
            ]
        );
    }
}
