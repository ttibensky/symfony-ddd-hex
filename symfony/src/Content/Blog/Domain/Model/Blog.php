<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Model;

use App\Content\Domain\Model\Content;

final class Blog extends Content
{
    public function getType(): string
    {
        return parent::TYPE_BLOG;
    }
}
