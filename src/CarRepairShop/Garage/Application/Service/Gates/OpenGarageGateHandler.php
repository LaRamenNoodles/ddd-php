<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Service\Gates;

use App\CarRepairShop\Garage\Application\Model\OpenGarageGateCommand;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class OpenGarageGateHandler
{
    public function __construct(
        private readonly GarageRepositoryInterface $garageRepository,
        private readonly MessageBusInterface $bus,
    ) {
    }

    public function __invoke(OpenGarageGateCommand $command)
    {
        $garage = $this->garageRepository->findById($command->garageId);

        $garage->openGate();

        foreach ($garage->pullDomainEvents() as $event) {
            $this->bus->dispatch($event);
        }
    }
}
