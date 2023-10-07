<?php

declare(strict_types=1);

namespace App\Common\Domain\Bus\Event;

interface EventSubscriber
{
    public static function subscribedTo(): array;
}
