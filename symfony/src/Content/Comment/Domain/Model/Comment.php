<?php

declare(strict_types=1);

namespace App\Content\Comment\Domain\Model;

use App\Content\Domain\Model\Content;

class Comment extends Content
{
    public function getType(): string
    {
        return parent::TYPE_COMMENT;
    }
}
