<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Application\Controller;

use App\CarRepairShop\Garage\Application\Model\OpenGarageGateCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class OpenGarageGateController extends AbstractController
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    public function __invoke(string $garageId): Response
    {
        $this->bus->dispatch(new OpenGarageGateCommand(garageId: $garageId));

        return $this->redirectToRoute('garage-manager');
    }
}
