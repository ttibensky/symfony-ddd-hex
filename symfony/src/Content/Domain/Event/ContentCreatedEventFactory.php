<?php

declare(strict_types=1);

namespace App\Content\Domain\Event;

use App\Content\Blog\Domain\Event\BlogCreatedEvent;
use App\Content\Comment\Domain\Event\CommentCreatedEvent;
use App\Content\Comment\Domain\Model\Comment;
use App\Content\Domain\Model\Content;

class ContentCreatedEventFactory
{
    public static function createEvent(Content $content, ...$args)
    {
        return match ($content->getType()) {
            Comment::TYPE_BLOG => new BlogCreatedEvent($content, ...$args),
            Comment::TYPE_COMMENT => new CommentCreatedEvent($content, ...$args),
            default => throw new \Exception('Unknown content type'), // @TODO use custom exception
        };
    }
}
