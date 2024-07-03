<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Service\Gates;

use App\CarRepairShop\Garage\Application\Model\GarageGateOpenedCommand;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GarageGateOpenedHandler
{
    public function __construct(private readonly GarageRepositoryInterface $garageRepository)
    {
    }

    public function __invoke(GarageGateOpenedCommand $command): void
    {
        $this->garageRepository->save($command->garage);
    }
}
