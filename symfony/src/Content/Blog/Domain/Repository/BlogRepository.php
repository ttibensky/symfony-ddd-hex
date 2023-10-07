<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Repository;

use App\Content\Blog\Domain\Model\Blog;

interface BlogRepository
{
    public function get(int $id): ?Blog;
    public function save(Blog $blog): void;
}
