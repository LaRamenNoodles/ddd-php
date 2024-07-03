<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Service\Garage;

use App\CarRepairShop\Garage\Application\Model\RemovedCarFromGarageCommand;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class RemovedCarFromGarageHandler
{
    public function __construct(
        private readonly GarageRepositoryInterface $garageRepository,
    ) {
    }

    public function __invoke(RemovedCarFromGarageCommand $command): void
    {
        $this->garageRepository->save($command->garage);
    }
}
