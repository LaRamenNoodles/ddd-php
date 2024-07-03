<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Service\Gates;

use App\CarRepairShop\Garage\Application\Model\CloseGarageGateCommand;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class CloseGarageGateHandler
{
    public function __construct(
        private readonly GarageRepositoryInterface $garageRepository,
        private readonly MessageBusInterface $bus,
    ) {
    }

    public function __invoke(CloseGarageGateCommand $command): void
    {
        $garage = $this->garageRepository->findById($command->garageId);

        $garage->closeGate();

        foreach ($garage->pullDomainEvents() as $event) {
            $this->bus->dispatch($event);
        }
    }
}
