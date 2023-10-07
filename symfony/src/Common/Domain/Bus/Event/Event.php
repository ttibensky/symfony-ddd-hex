<?php

declare(strict_types=1);

namespace App\Common\Domain\Bus\Event;
use App\Common\Domain\Util\Uuid;

abstract class Event
{
    public function __construct(
        private string $aggregateId,
        private ?string $eventId = null,
        private ?string $occurredOn = null,
    ) {
        $this->aggregateId = $aggregateId;
        $this->eventId = $eventId ?? Uuid::generate();
        $this->occurredOn = $occurredOn ?? date('c');
    }

    abstract public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $createdAt
    ): self;

    abstract public static function eventName(): string;

    abstract public function toPrimitives(): array;

    public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    public function eventId(): string
    {
        return $this->eventId;
    }

    public function setEventIdIfNull(string $id)
    {
        $this->eventId ??= $id;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }
}
