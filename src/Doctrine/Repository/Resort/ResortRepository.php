<?php
declare(strict_types=1);

namespace App\Doctrine\Repository\Resort;

use App\Doctrine\Interfaces\ResortRepositoryInterface;
use App\Entity\Resort\Resort;
use App\Exception\Resort\ResortNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Throwable;

final class ResortRepository extends ServiceEntityRepository implements ResortRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resort::class);
    }

    /**
     * @inheritdoc
     */
    public function get(int $id): Resort
    {
        /** @var Resort|null $entity */
        $entity = $this->find($id);
        if ($entity === null) {
            throw new ResortNotFoundException();
        }

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function store(Resort $resort): Resort
    {
        $this->getEntityManager()->persist($resort);
        $this->getEntityManager()->flush($resort);

        return $resort;
    }
}
