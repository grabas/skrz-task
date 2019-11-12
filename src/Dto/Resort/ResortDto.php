<?php
declare(strict_types=1);

namespace App\Dto\Resort;

use DateTime;

class ResortDto
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $country;

    /** @var string|null */
    private $area;

    /** @var string|null */
    private $city;

    /** @var string */
    private $description;

    /** @var float|null */
    private $latitude;

    /** @var float|null */
    private $longitude;

    /** @var string */
    private $source;

    /** @var ResortRatingDto */
    private $rating;

    /** @var DateTime */
    private $dateCreated;

    /** @var DateTime */
    private $dateUpdated;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ResortDto
     */
    public function setId(int $id): ResortDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ResortDto
     */
    public function setName(string $name): ResortDto
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return ResortDto
     */
    public function setCountry(string $country): ResortDto
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @param string|null $area
     * @return ResortDto
     */
    public function setArea(?string $area): ResortDto
    {
        $this->area = $area;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return ResortDto
     */
    public function setCity(?string $city): ResortDto
    {
        $this->city = $city;
        return $this;
    }


    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ResortDto
     */
    public function setDescription(string $description): ResortDto
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @param float|null $latitude
     * @return ResortDto
     */
    public function setLatitude(?float $latitude): ResortDto
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    /**
     * @param float|null $longitude
     * @return ResortDto
     */
    public function setLongitude(?float $longitude): ResortDto
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     * @return ResortDto
     */
    public function setSource(string $source): ResortDto
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return ResortRatingDto
     */
    public function getRating(): ResortRatingDto
    {
        return $this->rating;
    }

    /**
     * @param ResortRatingDto $rating
     * @return ResortDto
     */
    public function setRating(ResortRatingDto $rating): ResortDto
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param DateTime $dateCreated
     * @return ResortDto
     */
    public function setDateCreated(DateTime $dateCreated): ResortDto
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @param DateTime $dateUpdated
     * @return ResortDto
     */
    public function setDateUpdated(DateTime $dateUpdated): ResortDto
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }
}
