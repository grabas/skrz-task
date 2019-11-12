<?php
declare(strict_types=1);

namespace App\Entity\Resort;

use DateTime;

class ResortRating
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

    /** @var Resort */
    private $resort;

    /**
     * ResortRating constructor.
     * @param float $accommodationRating
     * @param float $foodRating
     * @param float $surroundingsRating
     * @param float $priceRating
     * @param float $ratingValue
     * @param float $bestRating
     * @param int $ratingCount
     */
    public function __construct(
        float $accommodationRating,
        float $foodRating,
        float $surroundingsRating,
        float $priceRating,
        float $ratingValue,
        float $bestRating,
        int $ratingCount
    ) {
        $this->accommodationRating = $accommodationRating;
        $this->foodRating = $foodRating;
        $this->surroundingsRating = $surroundingsRating;
        $this->priceRating = $priceRating;
        $this->ratingValue = $ratingValue;
        $this->bestRating = $bestRating;
        $this->ratingCount = $ratingCount;
        $this->dateUpdated = new DateTime();
    }

    /**
     * @return ResortRatingIdentity
     */
    public function getIdentity(): ResortRatingIdentity
    {
        return new ResortRatingIdentity($this->id);
    }

    /**
     * @return float
     */
    public function getAccommodationRating(): float
    {
        return $this->accommodationRating;
    }

    /**
     * @return float
     */
    public function getFoodRating(): float
    {
        return $this->foodRating;
    }

    /**
     * @return float
     */
    public function getSurroundingsRating(): float
    {
        return $this->surroundingsRating;
    }

    /**
     * @return float
     */
    public function getPriceRating(): float
    {
        return $this->priceRating;
    }

    /**
     * @return float
     */
    public function getRatingValue(): float
    {
        return $this->ratingValue;
    }

    /**
     * @return float
     */
    public function getBestRating(): float
    {
        return $this->bestRating;
    }

    /**
     * @return int
     */
    public function getRatingCount(): int
    {
        return $this->ratingCount;
    }

    /**
     * @return DateTime
     */
    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @return Resort
     */
    public function getResort(): Resort
    {
        return $this->resort;
    }
}
