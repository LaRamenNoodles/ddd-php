<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Domain;

interface CarRepositoryInterface
{
    public function findById(string $carId): ?Car;

    public function save(Car $car): void;
}
