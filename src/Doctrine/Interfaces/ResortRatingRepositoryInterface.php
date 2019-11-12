<?php
declare(strict_types=1);

namespace App\Doctrine\Interfaces;

use App\Entity\Resort\ResortRating;
use App\Exception\Resort\ResortRatingNotFoundException;
use Throwable;

interface ResortRatingRepositoryInterface
{
    /**
     * @param int $id
     * @throws ResortRatingNotFoundException
     * @return ResortRating
     */
    public function get(int $id): ResortRating;

    /**
     * @param ResortRating $resortRating
     * @return ResortRating
     * @throws Throwable
     */
    public function store(ResortRating $resortRating): ResortRating;
}
