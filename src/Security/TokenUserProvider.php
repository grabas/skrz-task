<?php
declare(strict_types=1);

namespace App\Security;

use App\Exception\User\UserNotFoundException;
use App\Service\TokenService;
use App\Service\UserService;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class TokenUserProvider
 */
class TokenUserProvider implements UserProviderInterface
{
    /** @var TokenService */
    private $tokenService;

    /** @var UserService */
    private $userService;

    /**
     * TokenUserProvider constructor.
     * @param TokenService $tokenService
     * @param UserService $userService
     */
    public function __construct(TokenService $tokenService, UserService $userService)
    {
        $this->tokenService = $tokenService;
        $this->userService = $userService;
    }

    /**
     * @param string $token
     * @return string|null
     */
    public function getUsernameForApiKey(string $token): ?string
    {
        $userDto = $this->tokenService->getUserByToken($token);
        return $userDto->getLogin();
    }

    /**
     * @param string $login
     * @return User
     */
    public function loadUserByUsername($login): User
    {
        try {
            $user = $this->userService->getByLogin($login);
        } catch (UserNotFoundException $e) {
            throw new UsernameNotFoundException($e->getMessage());
        }
        return new User(
            $user->getLogin(),
            null,
            ['ROLE_API']
        );
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        throw new UnsupportedUserException();
        return $user;
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class): bool
    {
        return $class === User::class;
    }
}
