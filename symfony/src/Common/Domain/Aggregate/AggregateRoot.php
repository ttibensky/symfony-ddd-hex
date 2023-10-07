<?php

declare(strict_types=1);

namespace App\Common\Domain\Aggregate;

use App\Common\Domain\Bus\Event\Event;
use App\Common\Domain\Model\ModelReference;

abstract class AggregateRoot implements ModelReference
{
    private array $events = [];

    abstract public function toArray(): array;

    abstract public static function fromArray(array $parameters): self;

    final public function pullEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    final protected function record(Event $event): void
    {
        $this->events[] = $event;
    }
}
