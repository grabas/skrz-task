<?php
declare(strict_types=1);

namespace App\Doctrine\Interfaces;

use App\Entity\Resort\Resort;
use App\Exception\Resort\ResortNotFoundException;
use Throwable;

interface ResortRepositoryInterface
{
    /**
     * @param int $id
     * @throws ResortNotFoundException
     * @return Resort
     */
    public function get(int $id): Resort;

    /**
     * @param Resort $resort
     * @return Resort
     * @throws Throwable
     */
    public function store(Resort $resort): Resort;
}
