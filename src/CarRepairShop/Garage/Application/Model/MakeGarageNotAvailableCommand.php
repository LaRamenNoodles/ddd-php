<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Model;

readonly class MakeGarageNotAvailableCommand
{
    public function __construct(
        public string $garageId,
    ) {
    }
}
