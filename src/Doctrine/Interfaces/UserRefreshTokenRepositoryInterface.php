<?php
declare(strict_types=1);

namespace App\Doctrine\Interfaces;

use App\Entity\User\RefreshToken;

interface UserRefreshTokenRepositoryInterface
{
    /**
     * @param string $token
     * @return RefreshToken
     */
    public function getByToken(string $token): RefreshToken;

    /**
     * @param RefreshToken $accessToken
     * @return RefreshToken
     */
    public function store(RefreshToken $accessToken): RefreshToken;
}
