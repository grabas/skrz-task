<?php
declare(strict_types=1);

namespace App\Entity\Resort;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Resort
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

    /** @var ResortRating */
    private $rating;

    /** @var DateTime */
    private $dateCreated;

    /** @var DateTime */
    private $dateUpdated;

    /** @var ArrayCollection */
    private $media;

    /**
     * @param string $name
     * @param string $country
     * @param string|null $area
     * @param string|null $city
     * @param string $description
     * @param float|null $latitude
     * @param float|null $longitude
     * @param string $source
     * @param ResortRating $rating
     */
    public function __construct(
        string $name,
        string $country,
        ?string $area,
        ?string $city,
        string $description,
        ?float $latitude,
        ?float $longitude,
        string $source,
        ResortRating $rating
    ) {
        $this->name = $name;
        $this->country = $country;
        $this->area = $area;
        $this->city = $city;
        $this->description = $description;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->source = $source;
        $this->rating = $rating;
        $this->media = new ArrayCollection();
        $this->dateCreated = new DateTime();
        $this->dateUpdated = new DateTime();
    }

    /**
     * @return ResortIdentity
     */
    public function getIdentity(): ResortIdentity
    {
        return new ResortIdentity($this->id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getArea(): ?string
    {
        return $this->area;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return float|null
     */
    public function getLatitude(): ?float
    {
        return (float) $this->latitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude(): ?float
    {
        return (float) $this->longitude;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return ResortRating
     */
    public function getRating(): ResortRating
    {
        return $this->rating;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @return DateTime
     */
    public function getDateUpdated(): DateTime
    {
        return $this->dateUpdated;
    }

    /**
     * @return Collection<ResortMedia>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }
}
