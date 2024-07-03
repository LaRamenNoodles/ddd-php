<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Service\Gates;

use App\CarRepairShop\Garage\Application\Model\GarageGateClosedCommand;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GarageGateClosedHandler
{
    public function __construct(private readonly GarageRepositoryInterface $garageRepository)
    {
    }

    public function __invoke(GarageGateClosedCommand $command): void
    {
        $this->garageRepository->save($command->garage);
    }
}
