<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Command;

use App\Common\Domain\Bus\Command\Command;
use App\Common\Domain\Model\ModelReference;

final class CreateBlogCommand implements Command
{
    public function __construct(
        private readonly string $title,
        private readonly string $description,
        private readonly ModelReference $author,
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthor(): ModelReference
    {
        return $this->author;
    }
}
