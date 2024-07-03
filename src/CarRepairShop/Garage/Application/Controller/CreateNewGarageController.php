<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Controller;

use App\CarRepairShop\Garage\Application\Model\CreateNewGarageCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateNewGarageController extends AbstractController
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    public function __invoke(): Response
    {
        $this->bus->dispatch(new CreateNewGarageCommand(isGateOpen: false, isAvailable: true));

        return $this->redirectToRoute('garage-manager');
    }
}
