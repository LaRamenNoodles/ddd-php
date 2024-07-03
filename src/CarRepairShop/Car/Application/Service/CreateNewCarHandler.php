<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Application\Service;

use App\CarRepairShop\Car\Application\Model\CreateNewCarCommand;
use App\CarRepairShop\Car\Domain\Car;
use App\CarRepairShop\Car\Domain\CarRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateNewCarHandler
{
    public function __construct(
        private readonly CarRepositoryInterface $carRepository
    ) {
    }

    public function __invoke(CreateNewCarCommand $command): void
    {
        $car = new Car(
            plateNumber: $this->generateRandomPlateNumber(),
            isInGarage: false,
        );

        $this->carRepository->save($car);
    }

    private function generateRandomPlateNumber(): string
    {
        $letters = '';
        for ($i = 0; $i < 3; ++$i) {
            $letters .= chr(rand(65, 90));
        }

        $numbers = '';
        for ($i = 0; $i < 3; ++$i) {
            $numbers .= rand(0, 9);
        }

        $randomPlateNumber = $letters.$numbers;

        return $randomPlateNumber;
    }
}
