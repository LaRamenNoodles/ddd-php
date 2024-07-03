<?php

declare(strict_types=1);

namespace App\CarRepairShop\CustomerService\Application\Controller;

use App\CarRepairShop\CustomerService\Application\Model\CreateCustomerServiceCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class RegisterCarController extends AbstractController
{
    public function __construct(
        private readonly MessageBusInterface $bus
    ) {
    }

    public function __invoke(string $firstname, string $lastname, string $carPlateNumber): Response
    {
        $this->bus->dispatch(new CreateCustomerServiceCommand(
            $firstname,
            $lastname,
            $carPlateNumber,
        ));

        return new Response('New customer was registered');
    }
}
