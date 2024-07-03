<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Infrastructure;

use App\CarRepairShop\Car\Domain\Car;
use App\CarRepairShop\Car\Domain\CarRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CarRepository extends ServiceEntityRepository implements CarRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    public function findById(string $carId): ?Car
    {
        return $this->find($carId);
    }

    public function save(Car $car): void
    {
        $this->getEntityManager()->persist($car);
        $this->getEntityManager()->flush();
    }

    public function findAllNotInGarageAndSortByDateDesc(): array
    {
        return $this->createQueryBuilder('c')
        ->where('c.isInGarage = false')
        ->orderBy('c.createdAt', 'DESC')
        ->getQuery()
        ->getResult();
    }
}
