<?php

declare(strict_types=1);

namespace App\CarRepairShop\CustomerService\Domain;

interface CustomerServiceRepositoryInterface
{
    public function findById(string $customerServiceId): ?CustomerService;

    public function save(CustomerService $customerService): void;

}
