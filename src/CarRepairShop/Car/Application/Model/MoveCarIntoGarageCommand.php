<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Application\Model;

readonly class MoveCarIntoGarageCommand
{
    public function __construct(
        public string $carId,
    ) {
    }
}
