<?php
declare(strict_types=1);

namespace App\Dto\Resort;

class ResortCreateDto
{
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

    /** @var float */
    private $accommodationRating;

    /** @var float */
    private $foodRating;

    /** @var float */
    private $surroundingsRating;

    /** @var float */
    private $priceRating;

    /** @var float */
    private $ratingValue;

    /** @var float */
    private $bestRating;

    /** @var int */
    private $ratingCount;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ResortCreateDto
     */
    public function setName(string $name): ResortCreateDto
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
     * @return ResortCreateDto
     */
    public function setCountry(string $country): ResortCreateDto
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
     * @return ResortCreateDto
     */
    public function setArea(?string $area): ResortCreateDto
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
     * @return ResortCreateDto
     */
    public function setCity(?string $city): ResortCreateDto
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
     * @return ResortCreateDto
     */
    public function setDescription(string $description): ResortCreateDto
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
     * @return ResortCreateDto
     */
    public function setLatitude(?float $latitude): ResortCreateDto
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
     * @return ResortCreateDto
     */
    public function setLongitude(?float $longitude): ResortCreateDto
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
     * @return ResortCreateDto
     */
    public function setSource(string $source): ResortCreateDto
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return float
     */
    public function getAccommodationRating(): float
    {
        return $this->accommodationRating;
    }

    /**
     * @param float $accommodationRating
     * @return ResortCreateDto
     */
    public function setAccommodationRating(float $accommodationRating): ResortCreateDto
    {
        $this->accommodationRating = $accommodationRating;
        return $this;
    }

    /**
     * @return float
     */
    public function getFoodRating(): float
    {
        return $this->foodRating;
    }

    /**
     * @param float $foodRating
     * @return ResortCreateDto
     */
    public function setFoodRating(float $foodRating): ResortCreateDto
    {
        $this->foodRating = $foodRating;
        return $this;
    }

    /**
     * @return float
     */
    public function getSurroundingsRating(): float
    {
        return $this->surroundingsRating;
    }

    /**
     * @param float $surroundingsRating
     * @return ResortCreateDto
     */
    public function setSurroundingsRating(float $surroundingsRating): ResortCreateDto
    {
        $this->surroundingsRating = $surroundingsRating;
        return $this;
    }

    /**
     * @return float
     */
    public function getPriceRating(): float
    {
        return $this->priceRating;
    }

    /**
     * @param float $priceRating
     * @return ResortCreateDto
     */
    public function setPriceRating(float $priceRating): ResortCreateDto
    {
        $this->priceRating = $priceRating;
        return $this;
    }

    /**
     * @return float
     */
    public function getRatingValue(): float
    {
        return $this->ratingValue;
    }

    /**
     * @param float $ratingValue
     * @return ResortCreateDto
     */
    public function setRatingValue(float $ratingValue): ResortCreateDto
    {
        $this->ratingValue = $ratingValue;
        return $this;
    }

    /**
     * @return float
     */
    public function getBestRating(): float
    {
        return $this->bestRating;
    }

    /**
     * @param float $bestRating
     * @return ResortCreateDto
     */
    public function setBestRating(float $bestRating): ResortCreateDto
    {
        $this->bestRating = $bestRating;
        return $this;
    }

    /**
     * @return int
     */
    public function getRatingCount(): int
    {
        return $this->ratingCount;
    }

    /**
     * @param int $ratingCount
     * @return ResortCreateDto
     */
    public function setRatingCount(int $ratingCount): ResortCreateDto
    {
        $this->ratingCount = $ratingCount;
        return $this;
    }
}
