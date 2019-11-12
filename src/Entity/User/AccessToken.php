<?php
declare(strict_types=1);

namespace App\Entity\User;

use DateTime;

class AccessToken implements TokenInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $token;

    /** @var DateTime */
    private $expires;

    /** @var DateTime */
    private $lastUpdated;

    /** @var DateTime */
    private $dateCreated;

    /** @var User */
    private $user;

    /** @var RefreshToken */
    private $refreshToken;

    /**
     * AccessToken constructor.
     * @param string $token
     * @param DateTime $expires
     * @param RefreshToken $refreshToken
     */
    public function __construct(string $token, DateTime $expires, RefreshToken $refreshToken)
    {
        $this->token = $token;
        $this->user = $refreshToken->getUser();
        $this->dateCreated = new DateTime();
        $this->lastUpdated = new DateTime();
        $this->expires = $expires;
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return IdentityInterface
     */
    public function getIdentity(): IdentityInterface
    {
        return new AccessTokenIdentity($this->id);
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
    public function getExpires(): DateTime
    {
        return $this->expires;
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
    public function getDateCreated(): DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return RefreshToken
     */
    public function getRefreshToken(): RefreshToken
    {
        return $this->refreshToken;
    }

    /**
     * @param int $minutes
     * @return AccessToken
     * @throws \Exception
     */
    public function changeExpiration(int $minutes): AccessToken
    {
        $this->expires = (new DateTime())->modify('+ ' . $minutes . ' minutes');
        $this->lastUpdated = new DateTime();
        return $this;
    }

    /**
     * @param string $token
     * @return AccessToken
     */
    public function setToken(string $token): AccessToken
    {
        $this->lastUpdated = new \DateTime();
        $this->token = $token;
        return $this;
    }

    /**
     * @param \DateTime $dateTime
     * @return AccessToken
     */
    public function setDateExpired(\DateTime $dateTime): AccessToken
    {
        $this->expires = $dateTime;
        return $this;
    }
}
