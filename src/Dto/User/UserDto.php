<?php
declare(strict_types=1);

namespace App\Dto\User;

class UserDto
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $login;

    /** @var string */
    private $password;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserDto
     */
    public function setId(int $id): UserDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserDto
     */
    public function setName(string $name): UserDto
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return UserDto
     */
    public function setLogin(string $login): UserDto
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return UserDto
     */
    public function setPassword(string $password): UserDto
    {
        $this->password = $password;
        return $this;
    }
}
