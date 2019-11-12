<?php
declare(strict_types=1);

namespace App\Dto\Resort;

use DateTime;

class ResortRatingDto
{
    /** @var int */
    private $id;

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
     * @return ResortRatingDto
     */
    public function setId(int $id): ResortRatingDto
    {
        $this->id = $id;
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
     * @return ResortRatingDto
     */
    public function setAccommodationRating(float $accommodationRating): ResortRatingDto
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
     * @return ResortRatingDto
     */
    public function setFoodRating(float $foodRating): ResortRatingDto
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
     * @return ResortRatingDto
     */
    public function setSurroundingsRating(float $surroundingsRating): ResortRatingDto
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
     * @return ResortRatingDto
     */
    public function setPriceRating(float $priceRating): ResortRatingDto
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
     * @return ResortRatingDto
     */
    public function setRatingValue(float $ratingValue): ResortRatingDto
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
     * @return ResortRatingDto
     */
    public function setBestRating(float $bestRating): ResortRatingDto
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
     * @return ResortRatingDto
     */
    public function setRatingCount(int $ratingCount): ResortRatingDto
    {
        $this->ratingCount = $ratingCount;
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
     * @return ResortRatingDto
     */
    public function setDateUpdated(DateTime $dateUpdated): ResortRatingDto
    {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }
}
