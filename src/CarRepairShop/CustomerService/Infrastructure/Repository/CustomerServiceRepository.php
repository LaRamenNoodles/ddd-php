<?php

declare(strict_types=1);

namespace App\CarRepairShop\CustomerService\Infrastructure\Repository;

use App\CarRepairShop\CustomerService\Domain\CustomerService;
use App\CarRepairShop\CustomerService\Domain\CustomerServiceRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CustomerServiceRepository extends ServiceEntityRepository implements CustomerServiceRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerService::class);
    }

    public function findById(string $customerServiceId): ?CustomerService
    {
        return $this->findById($customerServiceId);
    }

    public function persist(CustomerService $customerService): void
    {
        $this->getEntityManager()->persist($customerService);
    }

    public function save(): void
    {
        $this->getEntityManager()->flush();
    }
}
