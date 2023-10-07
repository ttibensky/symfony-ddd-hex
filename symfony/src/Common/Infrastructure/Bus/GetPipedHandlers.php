<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Bus;

use App\Common\Domain\Bus\Event\EventSubscriber;

class GetPipedHandlers
{
    public static function forPipedCallables(iterable $callables): array
    {
        $callable = self::pipedCallablesReducer();
        $acc = [];
        foreach ($callables as $key => $value) {
            $acc = $callable($acc, $value, $key);
        }
    
        return $acc;
    }

    private static function pipedCallablesReducer(): callable
    {
        return static function ($subscribers, EventSubscriber $subscriber): array {
            $subscribedEvents = $subscriber::subscribedTo();

            foreach ($subscribedEvents as $subscribedEvent) {
                $subscribers[$subscribedEvent][] = $subscriber;
            }

            return $subscribers;
        };
    }
}
