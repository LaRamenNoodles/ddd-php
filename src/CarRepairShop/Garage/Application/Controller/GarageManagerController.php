<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Controller;

use App\CarRepairShop\Car\Domain\CarRepositoryInterface;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GarageManagerController extends AbstractController
{
    public function __construct(
        private readonly GarageRepositoryInterface $garageRepository,
        private readonly CarRepositoryInterface $carRepository,
    ) {
    }

    public function __invoke()
    {
        $garages = $this->garageRepository->findAllAndSortByDateDesc();
        $cars = $this->carRepository->findAllNotInGarageAndSortByDateDesc();

        return $this->render('index.html.twig', [
            'garages' => $garages,
            'cars' => $cars,
        ]);
    }
}
