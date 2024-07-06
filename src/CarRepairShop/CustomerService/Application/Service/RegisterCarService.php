<?php

declare(strict_types=1);

namespace App\CarRepairShop\CustomerService\Application\Service;

use App\CarRepairShop\CustomerService\Application\Model\CreateCustomerServiceCommand;
use App\CarRepairShop\CustomerService\Domain\CustomerService;
use App\CarRepairShop\CustomerService\Domain\CustomerServiceRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class RegisterCarService
{
    public function __construct(private readonly CustomerServiceRepositoryInterface $customerServiceRepository) {}

    public function __invoke(CreateCustomerServiceCommand $command): void
    {
        $customerService = new CustomerService(
            firstname: $command->firstname,
            lastname: $command->lastname,
            carPlateNumber: $command->carPlateNumber,
        );

        $this->customerServiceRepository->save($customerService);
    }
}
