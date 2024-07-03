<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Service\Garage;

use App\CarRepairShop\Garage\Application\Model\CreateNewGarageCommand;
use App\CarRepairShop\Garage\Domain\Garage;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateNewGarageHandler
{
    public function __construct(private readonly GarageRepositoryInterface $garageRepository)
    {
    }

    public function __invoke(CreateNewGarageCommand $command): void
    {
        $garage = new Garage(
            isGateOpen: $command->isGateOpen,
            isAvailable: $command->isAvailable,
        );

        $this->garageRepository->save($garage);
    }
}
