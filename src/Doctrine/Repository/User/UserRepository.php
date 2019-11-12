<?php
declare(strict_types=1);

namespace App\Doctrine\Repository\User;

use App\Exception\User\UserNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use App\Doctrine\Interfaces\UserRepositoryInterface;
use App\Entity\User\User;
use Throwable;

final class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    /**
     * CurrencyRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function get(int $id): User
    {
        /** @var User|null $entity */
        $entity = $this->find($id);
        if ($entity === null) {
            throw new UserNotFoundException('User: ' . $id . ' not found');
        }
        return $entity;
    }

    /**
     * @param string $login
     * @return User
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByLogin(string $login): User
    {
        $qb = $this->createQueryBuilder('u');
        $qb
            ->where($qb->expr()->eq("u.login", ":login"))
            ->setParameter("login", $login);

        $user = $qb->getQuery()->getOneOrNullResult();

        if ($user == null) {
            throw new UserNotFoundException('User login: ' . $login . ' not found.');
        }

        return $user;
    }

    /**
     * @param User $entity
     * @return User
     * @throws Throwable
     */
    public function store(User $entity): User
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush($entity);

        return $entity;
    }
}
