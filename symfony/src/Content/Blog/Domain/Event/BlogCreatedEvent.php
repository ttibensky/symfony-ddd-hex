<?php

declare(strict_types=1);

namespace App\UserProfile\Domain\Event;

use App\Common\Domain\Bus\Event\Event;
use App\Content\Blog\Domain\Model\Blog;

class BlogCreatedEvent extends Event
{
    public function __construct(
        private Blog $blog,
        private ?string $eventId = null,
        private ?string $createdAt = null,
    ) {
        parent::__construct((string) $blog->getId(), $eventId, $createdAt);
    }

    public static function eventName(): string
    {
        return 'content.domain.blog.v1.created';
    }

    public function toPrimitives(): array
    {
        return $this->blog->toArray();
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $createdAt
    ): Event {
        return new self(
            Blog::fromArray($body),
            $eventId,
            $createdAt
        );
    }
}
