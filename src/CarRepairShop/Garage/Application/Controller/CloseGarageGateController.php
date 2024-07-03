<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Controller;

use App\CarRepairShop\Garage\Application\Model\CloseGarageGateCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CloseGarageGateController extends AbstractController
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    public function __invoke(string $garageId): Response
    {
        $this->bus->dispatch(new CloseGarageGateCommand(garageId: $garageId));

        return $this->redirectToRoute('garage-manager');
    }
}
