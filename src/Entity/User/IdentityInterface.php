<?php
declare(strict_types=1);

namespace App\Entity\User;

interface IdentityInterface
{
    /**
     * @return int
     */
    public function getId(): int;
}
