<?php
declare(strict_types=1);

namespace App\Entity\Resort;

use DateTime;

class ResortMedia
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $path;

    /** @var Resort */
    private $resort;

    /** @var DateTime */
    private $dateCreated;

    /**
     * ResortMedia constructor.
     * @param string $path
     * @param Resort $resort
     */
    public function __construct(string $name, string $path, Resort $resort)
    {
        $this->name = $name;
        $this->path = $path;
        $this->resort = $resort;
        $this->dateCreated = new DateTime();
    }

    /**
     * @return ResortMediaIdentity
     */
    public function getIdentity(): ResortMediaIdentity
    {
        return new ResortMediaIdentity($this->id);
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
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return Resort
     */
    public function getResort(): Resort
    {
        return $this->resort;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @return string
     */
    public function getFullPath(): string
    {
        return $this->path . "/" . $this->name;
    }
}
