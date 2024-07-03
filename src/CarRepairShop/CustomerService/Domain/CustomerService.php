<?php

declare(strict_types=1);

namespace App\CarRepairShop\CustomerService\Domain;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class CustomerService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $carPlateNumber = null;

    public function __construct(string $firstname, string $lastname, string $carPlateNumber)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->carPlateNumber = $carPlateNumber;
    }
}
