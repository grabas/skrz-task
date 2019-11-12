<?php
declare(strict_types=1);

namespace App\Service;

use App\Doctrine\Interfaces\UserAccessTokenRepositoryInterface;
use App\Doctrine\Interfaces\UserRefreshTokenRepositoryInterface;
use App\Assembler\User\TokenAssembler;
use App\Assembler\User\UserAssembler;
use App\Dto\User\TokenDto;
use App\Dto\User\UserDto;
use App\Entity\User\AccessToken;
use App\Entity\User\RefreshToken;
use App\Entity\User\TokenInterface;
use App\Exception\User\TokenExpiredException;
use App\Exception\User\TokenNotGeneratedException;
use App\Exception\User\TokenNotValidException;
use DateTime;
use Throwable;

class TokenService
{
    private const TOKEN_EXPIRE_MINUTES = 60;

    /** @var UserAccessTokenRepositoryInterface */
    private $accessTokenRepository;

    /** @var UserRefreshTokenRepositoryInterface */
    private $refreshTokenRepository;

    /**
     * TokenService constructor.
     * @param UserAccessTokenRepositoryInterface $accessTokenRepository
     * @param UserRefreshTokenRepositoryInterface $refreshTokenRepository
     */
    public function __construct(
        UserAccessTokenRepositoryInterface $accessTokenRepository,
        UserRefreshTokenRepositoryInterface $refreshTokenRepository
    ) {
        $this->accessTokenRepository = $accessTokenRepository;
        $this->refreshTokenRepository = $refreshTokenRepository;
    }

    /**
     * @param string $refreshTokenString
     * @throws TokenNotValidException
     * @throws Throwable
     * @return TokenDto
     */
    public function getAccessTokenFromRefreshToken(string $refreshTokenString): TokenDto
    {
        $refreshToken = $this->refreshTokenRepository->getByToken($refreshTokenString);

        $this->validateRefreshToken($refreshToken);

        $accessToken = $this->accessTokenRepository->findByRefreshToken($refreshToken);
        if ($accessToken !== null) {
            try {
                $this->validateAccessToken($accessToken);
            } catch (TokenExpiredException $e) {
                $accessToken = $this->regenerateAccessToken($accessToken);
            }
            return (new TokenAssembler())->toDto($accessToken);
        }

        $accessToken = new AccessToken(
            $this->generateToken(),
            (new DateTime())->modify(self::TOKEN_EXPIRE_MINUTES . ' minutes'),
            $refreshToken
        );

        $accessToken = $this->accessTokenRepository->store($accessToken);

        if ($accessToken == null) {
            throw new TokenNotValidException();
        }

        return (new TokenAssembler())->toDto($accessToken);
    }

    /**
     * @param string $accessTokenString
     * @return UserDto
     */
    public function getUserByToken(string $accessTokenString): UserDto
    {
        $accessToken = $this->accessTokenRepository->getByToken($accessTokenString);
        return (new UserAssembler())->toDto($accessToken->getUser());
    }

    /**
     * @param AccessToken $accessToken
     * @throws TokenNotValidException
     * @throws Throwable
     * @return void
     */
    private function validateAccessToken(AccessToken $accessToken): void
    {
        $user = $accessToken->getUser();

        if (!$user->isActive()) {
            throw new TokenNotValidException();
        }

        $this->validateTokenExpiration($accessToken);
    }

    /**
     * @param RefreshToken $refreshToken
     * @throws TokenNotValidException
     * @throws Throwable
     * @return void
     */
    private function validateRefreshToken(RefreshToken $refreshToken): void
    {
        $user = $refreshToken->getUser();

        if (!$user->isActive()) {
            throw new TokenNotValidException();
        }

        $this->validateTokenExpiration($refreshToken);
    }

    /**
     * @param TokenInterface $token
     * @throws TokenExpiredException
     * @throws Throwable
     */
    private function validateTokenExpiration(TokenInterface $token): void
    {
        if ($token->getExpires() < new DateTime()) {
            throw new TokenExpiredException('Token Expired: ' . $token->getExpires()->format('Y-m-d H:i:s'));
        }
    }

    /**
     * @param AccessToken $accessToken
     * @return AccessToken
     */
    private function regenerateAccessToken(AccessToken $accessToken): AccessToken
    {
        try {
            $accessToken
                ->setToken($this->generateToken())
                ->setDateExpired((new DateTime())->modify(self::TOKEN_EXPIRE_MINUTES . ' minutes'));
            $accessToken = $this->accessTokenRepository->store($accessToken);
            return $accessToken;
        } catch (Throwable $e) {
            throw new TokenNotGeneratedException();
        }
    }

    /**
     * @return string
     * @throws TokenNotGeneratedException
     * @throws Throwable
     */
    private function generateToken(): string
    {
        $randomData = openssl_random_pseudo_bytes(20);

        if ($randomData !== false && strlen($randomData) === 20) {
            return bin2hex($randomData);
        }

        throw new TokenNotGeneratedException();
    }
}
