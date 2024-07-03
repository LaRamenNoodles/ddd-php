<?php

declare(strict_types=1);

namespace App\CarRepairShop\Car\Domain;

use App\CarRepairShop\Car\Application\Model\MovedIntoGarageCommand;
use App\CarRepairShop\Garage\Domain\Garage;
use App\CarRepairShop\Shared\Aggregate\AggregateRoot;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Car extends AggregateRoot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    private ?string $plateNumber = null;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isInGarage = false;

    #[ORM\OneToOne(targetEntity: Garage::class, inversedBy: 'car')]
    #[ORM\JoinColumn(name: 'garage_id', referencedColumnName: 'id')]
    private ?Garage $garage = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    public function __construct(?string $plateNumber = null, bool $isInGarage = false)
    {
        $this->plateNumber = $plateNumber;
        $this->isInGarage = $isInGarage;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function moveInToGarage(Garage $garage): self
    {
        $this->garage = $garage;
        $this->isInGarage = true;

        $this->recordDomainEvent(new MovedIntoGarageCommand($this));

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function removeFromGarage(): void
    {
        $this->isInGarage = false;
        $this->garage = null;
    }

    public function getPlateNumber(): ?string
    {
        return $this->plateNumber;
    }

    public function isInGarage(): bool
    {
        return $this->isInGarage;
    }
}
