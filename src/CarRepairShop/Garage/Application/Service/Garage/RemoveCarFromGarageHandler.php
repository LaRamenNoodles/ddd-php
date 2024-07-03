<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Service\Garage;

use App\CarRepairShop\Garage\Application\Model\RemoveCarFromGarageCommand;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class RemoveCarFromGarageHandler
{
    public function __construct(
        private readonly GarageRepositoryInterface $garageRepository,
        private readonly MessageBusInterface $bus,
    ) {
    }

    public function __invoke(RemoveCarFromGarageCommand $command): void
    {
        $garage = $this->garageRepository->findById($command->garageId);

        $garage->removeCarFromGarage();

        foreach ($garage->pullDomainEvents() as $event) {
            $this->bus->dispatch($event);
        }
    }
}
