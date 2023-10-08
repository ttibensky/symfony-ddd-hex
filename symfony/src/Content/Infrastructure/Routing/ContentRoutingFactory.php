<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Routing;

use App\Content\Domain\Model\Content;

class ContentRoutingFactory
{
    public static function createGet(Content $content)
    {
        if ($content->getType() !== Content::TYPE_BLOG) {
            throw new \Exception('Unsupported content type'); // @TODO use custom exception
        }

        return $content->getType().'_get';
    }
}
