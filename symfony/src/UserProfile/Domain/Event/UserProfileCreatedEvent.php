<?php

declare(strict_types=1);

namespace App\UserProfile\Domain\Event;

use App\Common\Domain\Bus\Event\Event;
use App\UserProfile\Domain\Model\UserProfile;

class UserProfileCreatedEvent extends Event
{
    public function __construct(
        private UserProfile $userProfile,
        private ?string $eventId = null,
        private ?string $createdAt = null,
    ) {
        parent::__construct((string) $userProfile->getId(), $eventId, $createdAt);
    }

    public static function eventName(): string
    {
        return 'user_profile.domain.user_profile.v1.created';
    }

    public function toPrimitives(): array
    {
        return $this->userProfile->toArray();
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $createdAt
    ): Event {
        return new self(
            UserProfile::fromArray($body),
            $eventId,
            $createdAt
        );
    }
}
