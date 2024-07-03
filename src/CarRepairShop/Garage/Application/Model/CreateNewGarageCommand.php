<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Model;

readonly class CreateNewGarageCommand
{
    public function __construct(
        public bool $isGateOpen,
        public bool $isAvailable,
    ) {
    }
}
