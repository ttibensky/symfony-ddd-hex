<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Command;

use App\Common\Domain\Bus\Command\Command;

final class GetBlogCommand implements Command
{
    public function __construct(
        private readonly int $id,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }
}
