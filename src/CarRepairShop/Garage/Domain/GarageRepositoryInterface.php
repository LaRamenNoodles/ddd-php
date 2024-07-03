<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Domain;

interface GarageRepositoryInterface
{
    public function findById(string $garageId): ?Garage;

    public function save(Garage $garage): void;
}
