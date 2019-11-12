<?php
declare(strict_types=1);

namespace App\Dto\User;

use DateTime;

class TokenDto
{
    /** @var int */
    private $id;

    /** @var string */
    private $token;

    /** @var DateTime */
    private $dateCreated;

    /** @var DateTime */
    private $lastUpdated;

    /** @var DateTime */
    private $expires;

    /** @var int */
    private $userId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return TokenDto
     */
    public function setId(int $id): TokenDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return TokenDto
     */
    public function setToken(string $token): TokenDto
    {
        $this->token = $token;
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
     * @return TokenDto
     */
    public function setDateCreated(DateTime $dateCreated): TokenDto
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    /**
     * @param DateTime $lastUpdated
     * @return TokenDto
     */
    public function setLastUpdated(DateTime $lastUpdated): TokenDto
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpires(): DateTime
    {
        return $this->expires;
    }

    /**
     * @param DateTime $expires
     * @return TokenDto
     */
    public function setExpires(DateTime $expires): TokenDto
    {
        $this->expires = $expires;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return TokenDto
     */
    public function setUserId(int $userId): TokenDto
    {
        $this->userId = $userId;
        return $this;
    }
}
