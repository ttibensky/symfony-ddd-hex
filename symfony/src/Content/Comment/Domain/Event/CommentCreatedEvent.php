<?php

declare(strict_types=1);

namespace App\Content\Comment\Domain\Event;

use App\Common\Domain\Bus\Event\Event;
use App\Content\Comment\Domain\Model\Comment;

class CommentCreatedEvent extends Event
{
    public function __construct(
        private Comment $comment,
        private ?string $eventId = null,
        private ?string $createdAt = null,
    ) {
        parent::__construct((string) $comment->getId(), $eventId, $createdAt);
    }

    public static function eventName(): string
    {
        return 'content.domain.comment.v1.created';
    }

    public function toPrimitives(): array
    {
        return $this->comment->toArray();
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $createdAt
    ): Event {
        return new self(
            Comment::fromArray($body),
            $eventId,
            $createdAt
        );
    }
}
