<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Application\Controller;

use App\CarRepairShop\Car\Application\Model\MoveCarIntoGarageCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class MoveCarIntoGarageController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $bus,
    ) {
    }

    public function __invoke(string $carId)
    {
        $this->bus->dispatch(new MoveCarIntoGarageCommand($carId));

        return $this->redirectToRoute('garage-manager');
    }
}
