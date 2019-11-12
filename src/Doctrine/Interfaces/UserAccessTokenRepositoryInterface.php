<?php
declare(strict_types=1);

namespace App\Doctrine\Interfaces;

use App\Entity\User\AccessToken;
use App\Entity\User\RefreshToken;

interface UserAccessTokenRepositoryInterface
{
    /**
     * @param AccessToken $accessToken
     * @return AccessToken
     */
    public function store(AccessToken $accessToken): AccessToken;

    /**
     * @param string $token
     * @return AccessToken
     */
    public function getByToken(string $token): AccessToken;

    /**
     * @param RefreshToken $refreshToken
     * @return AccessToken|null
     */
    public function findByRefreshToken(RefreshToken $refreshToken): ?AccessToken;
}
