<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Infrastructure\Repository;

use App\CarRepairShop\Garage\Domain\Garage;
use App\CarRepairShop\Garage\Domain\GarageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GarageRepository extends ServiceEntityRepository implements GarageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Garage::class);
    }

    public function findById(string $garageId): ?Garage
    {
        return $this->find($garageId);
    }

    public function findAllAndSortByDateDesc(): array
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAvailableAndGatesOpen(): ?array
    {
        return $this->createQueryBuilder('g')
            ->where('g.isAvailable = true')
            ->andWhere('g.isGateOpen = true')
            ->orderBy('g.createdAt', 'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getResult();
    }

    public function save(Garage $garage): void
    {
        $this->getEntityManager()->persist($garage);
        $this->getEntityManager()->flush();
    }
}
