<?php
declare(strict_types=1);

namespace App\Assembler\User;

use App\Dto\User\UserDto;
use App\Entity\User\User;

class UserAssembler
{
    /**
     * @param User $user
     * @return UserDto
     */
    public function toDto(User $user): UserDto
    {
        $dto = new UserDto();

        $dto
            ->setId($user->getIdentity()->getId())
            ->setName($user->getName())
            ->setLogin($user->getLogin())
            ->setPassword($user->getPassword());

        return $dto;
    }
}
