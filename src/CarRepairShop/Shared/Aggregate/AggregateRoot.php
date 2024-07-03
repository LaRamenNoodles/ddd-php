<?php

declare(strict_types=1);

namespace App\CarRepairShop\Shared\Aggregate;

use App\CarRepairShop\Shared\Event\DomainEventInterface;

class AggregateRoot
{
    protected array $domainEvents;

    public function recordDomainEvent(DomainEventInterface $event): self
    {
        $this->domainEvents[] = $event;

        return $this;
    }

    public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }
}
