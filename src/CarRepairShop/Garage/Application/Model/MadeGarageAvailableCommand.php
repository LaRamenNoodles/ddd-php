<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Model;

use App\CarRepairShop\Garage\Domain\Garage;
use App\CarRepairShop\Shared\Event\DomainEventInterface;

readonly class MadeGarageAvailableCommand implements DomainEventInterface
{
    public function __construct(
        public Garage $garage,
    ) {
    }
}
