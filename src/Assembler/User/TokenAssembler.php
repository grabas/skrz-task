<?php
declare(strict_types=1);

namespace App\Assembler\User;

use App\Entity\User\TokenInterface;
use App\Dto\User\TokenDto;

class TokenAssembler
{
    /**
     * @param TokenInterface $token
     * @return TokenDto
     */
    public function toDto(TokenInterface $token): TokenDto
    {
        $dto = new TokenDto();

        $dto
            ->setId($token->getIdentity()->getId())
            ->setToken($token->getToken())
            ->setDateCreated($token->getDateCreated())
            ->setLastUpdated($token->getLastUpdated())
            ->setExpires($token->getExpires())
            ->setUserId($token->getUser()->getIdentity()->getId());

        return $dto;
    }
}
