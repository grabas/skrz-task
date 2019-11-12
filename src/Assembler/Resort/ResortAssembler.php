<?php
declare(strict_types=1);

namespace App\Assembler\Resort;

use App\Dto\Resort\ResortCreateDto;
use App\Dto\Resort\ResortDto;
use App\Entity\Resort\Resort;

class ResortAssembler
{
    /**
     * @param array $data
     * @return ResortCreateDto
     */
    public function toCreateDto(array $data): ResortCreateDto
    {
        $dto = new ResortCreateDto();

        $dto
            ->setName($data['name'])
            ->setDescription($data['description'])
            ->setCountry($data['country'])
            ->setArea($data['area'])
            ->setCity($data['city'])
            ->setSource($data['source'])
            ->setAccommodationRating((float) $data['accommodationRating'])
            ->setFoodRating((float) $data['foodRating'])
            ->setSurroundingsRating((float) $data['surroundingsRating'])
            ->setPriceRating((float) $data['priceRating'])
            ->setBestRating((float) $data['bestRating'])
            ->setRatingValue((float) $data['ratingValue'])
            ->setRatingCount((int) $data['ratingCount']);

        $latitude = $data['latitude'];
        if ($latitude != null) {
            $latitude = (float) $latitude;
        }

        $longitude = $data['longitude'];
        if ($longitude != null) {
            $longitude = (float) $longitude;
        }

        $dto
            ->setLatitude($latitude)
            ->setLongitude($longitude);

        return $dto;
    }

    /**
     * @param Resort $resort
     * @return ResortDto
     */
    public function toDto(Resort $resort): ResortDto
    {
        $dto = new ResortDto();

        $dto
            ->setId($resort->getIdentity()->getId())
            ->setName($resort->getName())
            ->setDescription($resort->getDescription())
            ->setCountry($resort->getCountry())
            ->setArea($resort->getArea())
            ->setCity($resort->getCity())
            ->setLatitude($resort->getLatitude())
            ->setLongitude($resort->getLongitude())
            ->setSource($resort->getSource())
            ->setDateCreated($resort->getDateCreated())
            ->setDateUpdated($resort->getDateUpdated())
            ->setRating(
                (new ResortRatingAssembler())->toDto($resort->getRating())
            );

        return $dto;
    }
}
