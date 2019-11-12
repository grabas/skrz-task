<?php
declare(strict_types=1);

namespace App\Doctrine\Interfaces;

use App\Entity\User\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function get(int $id): User;

    /**
     * @param string $login
     * @return User
     */
    public function getByLogin(string $login): User;
}
