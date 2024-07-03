<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Application\Controller;

use App\CarRepairShop\Car\Application\Model\CreateNewCarCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateNewCarController extends AbstractController
{
    public function __construct(private readonly MessageBusInterface $bus)
    {
    }

    public function __invoke()
    {
        $this->bus->dispatch(new CreateNewCarCommand());

        return $this->redirectToRoute('garage-manager');
    }
}
