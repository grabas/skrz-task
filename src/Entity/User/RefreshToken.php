<?php
declare(strict_types=1);

namespace App\Entity\User;

use DateTime;

class RefreshToken implements TokenInterface
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

    /** @var User */
    private $user;

    /**
     * @param string $token
     * @param DateTime $expires
     * @param User $user
     */
    public function __construct(string $token, DateTime $expires, User $user)
    {
        $this->token = $token;
        $this->user = $user;
        $this->dateCreated = new DateTime();
        $this->lastUpdated = new DateTime();
        $this->expires = $expires;
    }

    /**
     * @return IdentityInterface
     */
    public function getIdentity(): IdentityInterface
    {
        return new RefreshTokenIdentity($this->id);
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
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
    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    /**
     * @return DateTime
     */
    public function getExpires(): DateTime
    {
        return $this->expires;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param string $token
     * @return RefreshToken
     */
    public function changeToken(string $token): RefreshToken
    {
        $this->lastUpdated = new DateTime();
        $this->token = $token;
        return $this;
    }
}
