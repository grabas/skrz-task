<?php
declare(strict_types=1);

namespace App\Entity\User;

class User
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /** @var bool */
    private $active;

    /**
     * @return UserIdentity
     */
    public function getIdentity(): UserIdentity
    {
        return new UserIdentity($this->id);
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
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
