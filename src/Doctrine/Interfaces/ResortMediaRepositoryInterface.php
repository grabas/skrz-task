<?php
declare(strict_types=1);

namespace App\Doctrine\Interfaces;

use App\Entity\Resort\Resort;
use App\Entity\Resort\ResortMedia;
use App\Exception\Resort\ResortMediaNotFoundException;
use App\Exception\Resort\ResortNotFoundException;
use Throwable;

interface ResortMediaRepositoryInterface
{
    /**
     * @param int $id
     * @throws ResortMediaNotFoundException
     * @return ResortMedia
     */
    public function get(int $id): ResortMedia;

    /**
     * @param ResortMedia $resort
     * @return ResortMedia
     * @throws Throwable
     */
    public function store(ResortMedia $resort): ResortMedia;
}
