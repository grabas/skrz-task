<?php
declare(strict_types=1);

namespace App\Entity\User;

use \DateTime;

interface TokenInterface
{
    /**
     * @return IdentityInterface
     */
    public function getIdentity(): IdentityInterface;

    /**
     * @return string
     */
    public function getToken(): string;

    /**
     * @return DateTime
     */
    public function getDateCreated(): DateTime;

    /**
     * @return DateTime
     */
    public function getLastUpdated(): DateTime;

    /**
     * @return DateTime
     */
    public function getExpires(): DateTime;

    /**
     * @return User
     */
    public function getUser(): User;
}
