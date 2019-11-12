<?php
declare(strict_types=1);

namespace App\Assembler\Resort;

use App\Dto\Resort\ResortRatingDto;
use App\Entity\Resort\ResortRating;

class ResortRatingAssembler
{
    /**
     * @param ResortRating $rating
     * @return ResortRatingDto
     */
    public function toDto(ResortRating $rating): ResortRatingDto
    {
        $dto = new ResortRatingDto();

        $dto
            ->setId($rating->getIdentity()->getId())
            ->setRatingValue($rating->getRatingValue())
            ->setRatingCount($rating->getRatingCount())
            ->setBestRating($rating->getBestRating())
            ->setAccommodationRating($rating->getAccommodationRating())
            ->setFoodRating($rating->getFoodRating())
            ->setPriceRating($rating->getPriceRating())
            ->setSurroundingsRating($rating->getSurroundingsRating())
            ->setDateUpdated($rating->getDateUpdated());

        return $dto;
    }
}
