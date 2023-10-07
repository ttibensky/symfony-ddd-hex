<?php

declare(strict_types=1);

namespace App\Content\Comment\Domain\Repository;

use App\Content\Comment\Domain\Model\Comment;

interface CommentRepository
{
    public function save(Comment $blog): void;
}
