<?php
declare(strict_types=1);

namespace App\Service;

use App\Assembler\Resort\ResortAssembler;
use App\Doctrine\Interfaces\ResortRatingRepositoryInterface;
use App\Doctrine\Interfaces\ResortRepositoryInterface;
use App\Dto\Resort\ResortCreateDto;
use App\Dto\Resort\ResortDto;
use App\Entity\Resort\Resort;
use App\Entity\Resort\ResortRating;

class ResortService
{
    /** @var ResortRepositoryInterface */
    private $resortRepository;

    /** @var ResortRatingRepositoryInterface */
    private $resortRatingRepository;

    /**
     * ResortService constructor.
     * @param ResortRepositoryInterface $resortRepository
     * @param ResortRatingRepositoryInterface $resortRatingRepository
     */
    public function __construct(
        ResortRepositoryInterface $resortRepository,
        ResortRatingRepositoryInterface $resortRatingRepository
    ) {
        $this->resortRepository = $resortRepository;
        $this->resortRatingRepository = $resortRatingRepository;
    }

    /**
     * @param ResortCreateDto $resortCreateDto
     * @return ResortDto
     * @throws \Throwable
     */
    public function createResort(ResortCreateDto $resortCreateDto): ResortDto
    {
        $resortRating = new ResortRating(
            $resortCreateDto->getAccommodationRating(),
            $resortCreateDto->getFoodRating(),
            $resortCreateDto->getSurroundingsRating(),
            $resortCreateDto->getPriceRating(),
            $resortCreateDto->getRatingValue(),
            $resortCreateDto->getBestRating(),
            $resortCreateDto->getRatingCount()
        );

        $resortRating = $this->resortRatingRepository->store($resortRating);

        $resort = new Resort(
            $resortCreateDto->getName(),
            $resortCreateDto->getCountry(),
            $resortCreateDto->getArea(),
            $resortCreateDto->getCity(),
            $resortCreateDto->getDescription(),
            $resortCreateDto->getLatitude(),
            $resortCreateDto->getLongitude(),
            $resortCreateDto->getSource(),
            $resortRating
        );

        $resort = $this->resortRepository->store($resort);

        return (new ResortAssembler())->toDto($resort);
    }

    /**
     * @param int $id
     * @return ResortDto
     */
    public function getForApi(int $id): ResortDto
    {
        $resort = $this->resortRepository->get($id);
        return (new ResortAssembler())->toDto($resort);
    }
}
