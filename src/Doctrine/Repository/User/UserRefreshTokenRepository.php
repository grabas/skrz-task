<?php
declare(strict_types=1);

namespace App\Doctrine\Repository\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Doctrine\Interfaces\UserRefreshTokenRepositoryInterface;
use App\Entity\User\RefreshToken;
use App\Exception\User\TokenNotFoundException;

class UserRefreshTokenRepository extends ServiceEntityRepository implements UserRefreshTokenRepositoryInterface
{
    /**
     * UserRefreshTokenRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefreshToken::class);
    }

    /**
     * @param string $tokenString
     * @return RefreshToken
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByToken(string $tokenString): RefreshToken
    {
        $qb = $this->createQueryBuilder('rt');
        $qb
            ->where($qb->expr()->eq("rt.token", ":token"))
            ->setParameter("token", $tokenString);

        $token = $qb->getQuery()->getOneOrNullResult();

        if ($token === null) {
            throw new TokenNotFoundException('Token not found: ' . $tokenString);
        }

        return $token;
    }

    /**
     * @param RefreshToken $token
     * @return RefreshToken
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(RefreshToken $token): RefreshToken
    {
        $this->getEntityManager()->persist($token);
        $this->getEntityManager()->flush($token);

        return $token;
    }
}
