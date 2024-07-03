<?php

declare(strict_types=1);

namespace App\CarRepairShop\Garage\Domain;

use App\CarRepairShop\Car\Domain\Car;
use App\CarRepairShop\Garage\Application\Model\GarageGateClosedCommand;
use App\CarRepairShop\Garage\Application\Model\GarageGateOpenedCommand;
use App\CarRepairShop\Garage\Application\Model\MadeGarageAvailableCommand;
use App\CarRepairShop\Garage\Application\Model\MadeGarageNotAvailableCommand;
use App\CarRepairShop\Garage\Application\Model\RemovedCarFromGarageCommand;
use App\CarRepairShop\Shared\Aggregate\AggregateRoot;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Garage extends AggregateRoot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isGateOpen = false;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isAvailable = false;

    #[ORM\OneToOne(targetEntity: Car::class, mappedBy: 'garage')]
    private ?Car $car = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct(bool $isGateOpen, bool $isAvailable)
    {
        $this->isGateOpen = $isGateOpen;
        $this->isAvailable = $isAvailable;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function openGate(): void
    {
        $this->isGateOpen = true;

        $this->recordDomainEvent(new GarageGateOpenedCommand($this));
    }

    public function closeGate(): void
    {
        $this->isGateOpen = false;

        $this->recordDomainEvent(new GarageGateClosedCommand($this));
    }

    public function makeNotAvailable(): void
    {
        $this->isAvailable = false;

        $this->recordDomainEvent(new MadeGarageNotAvailableCommand($this));
    }

    public function makeAvailable(): void
    {
        $this->isAvailable = true;

        $this->recordDomainEvent(new MadeGarageAvailableCommand($this));
    }

    public function removeCarFromGarage(): void
    {
        $this->car->removeFromGarage();
        $this->car = null;

        $this->recordDomainEvent(new RemovedCarFromGarageCommand($this));
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function isGatesOpen(): bool
    {
        return $this->isGateOpen;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }
}
