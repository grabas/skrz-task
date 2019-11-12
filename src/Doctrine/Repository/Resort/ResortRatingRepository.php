<?php
declare(strict_types=1);

namespace App\Doctrine\Repository\Resort;

use App\Doctrine\Interfaces\ResortRatingRepositoryInterface;
use App\Entity\Resort\ResortRating;
use App\Exception\Resort\ResortRatingNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Throwable;

final class ResortRatingRepository extends ServiceEntityRepository implements ResortRatingRepositoryInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResortRating::class);
    }

    /**
     * @inheritdoc
     */
    public function get(int $id): ResortRating
    {
        /** @var ResortRating|null $entity */
        $entity = $this->find($id);
        if ($entity === null) {
            throw new ResortRatingNotFoundException();
        }

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function store(ResortRating $resortRating): ResortRating
    {
        $this->getEntityManager()->persist($resortRating);
        $this->getEntityManager()->flush($resortRating);

        return $resortRating;
    }
}
