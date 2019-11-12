<?php
declare(strict_types=1);

namespace App\Service;

use App\Assembler\Resort\ResortAssembler;
use App\Doctrine\Interfaces\ResortMediaRepositoryInterface;
use App\Doctrine\Interfaces\ResortRatingRepositoryInterface;
use App\Doctrine\Interfaces\ResortRepositoryInterface;
use App\Dto\Resort\ResortCreateDto;
use App\Dto\Resort\ResortDto;
use App\Entity\Resort\Resort;
use App\Entity\Resort\ResortMedia;
use App\Entity\Resort\ResortRating;
use App\Exception\BaseException;

class ResortMediaService
{
    /** @var string */
    private $projectDirectory;

    /** @var ResortRepositoryInterface */
    private $resortRepository;

    /** @var ResortMediaRepositoryInterface */
    private $resortMediaRepository;

    /**
     * ResortMediaService constructor.
     * @param string $projectDirectory
     * @param ResortRepositoryInterface $resortRepository
     * @param ResortMediaRepositoryInterface $resortMediaRepository
     */
    public function __construct(
        string $projectDirectory,
        ResortRepositoryInterface $resortRepository,
        ResortMediaRepositoryInterface $resortMediaRepository
    ) {
        $this->projectDirectory = $projectDirectory;
        $this->resortRepository = $resortRepository;
        $this->resortMediaRepository = $resortMediaRepository;
    }

    /**
     * @param int $resortId
     * @param string $imageUrl
     * @throws \Throwable
     */
    public function saveImage(int $resortId, string $imageUrl): void
    {
        $route = $this->projectDirectory . "/media/resort/" . $resortId;

        try {
            if (!is_dir($route)) {
                mkdir($route, 0777, true);
            }
            $explodedImageUrl = explode("/", $imageUrl);
            /** @var string $imageName */
            $imageName = array_pop($explodedImageUrl);
            file_put_contents($route . '/' . $imageName, file_get_contents($imageUrl));
            $this->storeMediaRelation($resortId, $imageName, $route);
        } catch (\Throwable $exception) {
            throw new BaseException('Error while storing resort media.');
        }
    }

    /**
     * @param int $resortId
     * @param string $imageName
     * @param string $route
     * @throws \Throwable
     */
    private function storeMediaRelation(int $resortId, string $imageName, string $route): void
    {
        $resort = $this->resortRepository->get($resortId);
        $path = str_replace($this->projectDirectory, "", $route);
        $media = new ResortMedia($imageName, $path, $resort);
        $this->resortMediaRepository->store($media);
    }
}
