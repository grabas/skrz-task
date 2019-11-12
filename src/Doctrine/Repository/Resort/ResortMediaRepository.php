<?php
declare(strict_types=1);

namespace App\Doctrine\Repository\Resort;

use App\Doctrine\Interfaces\ResortMediaRepositoryInterface;
use App\Entity\Resort\ResortMedia;
use App\Entity\Resort\ResortRating;
use App\Exception\Resort\ResortMediaNotFoundException;
use App\Exception\Resort\ResortRatingNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Throwable;

final class ResortMediaRepository extends ServiceEntityRepository implements ResortMediaRepositoryInterface
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
    public function get(int $id): ResortMedia
    {
        /** @var ResortMedia|null $entity */
        $entity = $this->find($id);
        if ($entity === null) {
            throw new ResortMediaNotFoundException();
        }

        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function store(ResortMedia $resortMedia): ResortMedia
    {
        $this->getEntityManager()->persist($resortMedia);
        $this->getEntityManager()->flush($resortMedia);

        return $resortMedia;
    }
}
