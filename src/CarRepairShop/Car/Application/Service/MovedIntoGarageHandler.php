<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Application\Service;

use App\CarRepairShop\Car\Application\Model\MovedIntoGarageCommand;
use App\CarRepairShop\Car\Domain\CarRepositoryInterface;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MovedIntoGarageHandler
{
    public function __construct(
        private readonly CarRepositoryInterface $carRepository,
        private readonly GarageRepositoryInterface $garageRepository,
    ) {
    }

    public function __invoke(MovedIntoGarageCommand $command): void
    {
        $this->carRepository->save($command->car);
    }
}
