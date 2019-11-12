<?php
declare(strict_types=1);

namespace App\Doctrine\Repository\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Entity\User\AccessToken;
use App\Doctrine\Interfaces\UserAccessTokenRepositoryInterface;
use App\Entity\User\RefreshToken;
use App\Exception\User\TokenNotFoundException;

class UserAccessTokenRepository extends ServiceEntityRepository implements UserAccessTokenRepositoryInterface
{
    /**
     * UserAccessTokenRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessToken::class);
    }

    /**
     * @param string $tokenString
     * @return AccessToken
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByToken(string $tokenString): AccessToken
    {
        $qb = $this->createQueryBuilder('at');
        $qb
            ->where($qb->expr()->eq("at.token", ":token"))
            ->setParameter("token", $tokenString);

        $token = $qb->getQuery()->getOneOrNullResult();

        if ($token == null) {
            throw new TokenNotFoundException('Access Token not found: ' . $tokenString);
        }

        return $token;
    }

    /**
     * @param RefreshToken $refreshToken
     * @return AccessToken|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByRefreshToken(RefreshToken $refreshToken): ?AccessToken
    {
        $qb = $this->createQueryBuilder('at');
        $qb
            ->where($qb->expr()->eq("at.refreshToken", ":refreshToken"))
            ->setParameter("refreshToken", $refreshToken)
            ->setMaxResults(1)
            ->orderBy('at.id', 'desc');

        $token = $qb->getQuery()->getOneOrNullResult();

        return $token;
    }

    /**
     * @param AccessToken $accessToken
     * @return AccessToken
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(AccessToken $accessToken): AccessToken
    {
        $this->getEntityManager()->persist($accessToken);
        $this->getEntityManager()->flush($accessToken);

        return $accessToken;
    }
}
