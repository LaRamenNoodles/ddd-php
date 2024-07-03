<?php

declare(strict_types=1);

namespace App\CarRepairShop\CustomerService\Application\Model;

readonly class CreateCustomerServiceCommand
{
    public function __construct(
        public string $firstname,
        public string $lastname,
        public string $carPlateNumber,
    ) {
    }
}
