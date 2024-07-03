<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Application\Model;

use App\CarRepairShop\Car\Domain\Car;
use App\CarRepairShop\Shared\Event\DomainEventInterface;

readonly class MovedIntoGarageCommand implements DomainEventInterface
{
    public function __construct(
        public Car $car,
    ) {
    }
}
