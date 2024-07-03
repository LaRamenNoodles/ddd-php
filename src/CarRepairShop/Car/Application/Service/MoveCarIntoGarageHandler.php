<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Application\Service;

use App\CarRepairShop\Car\Application\Model\MoveCarIntoGarageCommand;
use App\CarRepairShop\Car\Domain\CarRepositoryInterface;
use App\CarRepairShop\Garage\Application\Model\MakeGarageNotAvailableCommand;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
class MoveCarIntoGarageHandler
{
    public function __construct(
        private readonly CarRepositoryInterface $carRepository,
        private readonly GarageRepositoryInterface $garageRepository,
        private readonly MessageBusInterface $bus,
    ) {
    }

    public function __invoke(MoveCarIntoGarageCommand $command): void
    {
        $car = $this->carRepository->findById($command->carId);
        $garage = $this->garageRepository->findAvailableAndGatesOpen();

        if (!$garage) {
            throw new \Exception('No available garages at the moment');
        }

        $car->moveInToGarage($garage);

        $this->bus->dispatch(new MakeGarageNotAvailableCommand((string) $garage->getId()));

        foreach ($car->pullDomainEvents() as $event) {
            $this->bus->dispatch($event);
        }
    }
}
