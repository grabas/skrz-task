<?php
declare(strict_types=1);

namespace App\Service;

use App\Assembler\User\UserAssembler;
use App\Doctrine\Interfaces\UserRepositoryInterface;
use App\Dto\User\UserDto;

class UserService
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $login
     * @return UserDto
     */
    public function getByLogin(string $login): UserDto
    {
        $user = $this->userRepository->getByLogin($login);
        return (new UserAssembler())->toDto($user);
    }
}
