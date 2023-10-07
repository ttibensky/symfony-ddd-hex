<?php

declare(strict_types=1);

namespace App\Content\Comment\Domain\Command;

use App\Common\Domain\Bus\Command\Command;
use App\Common\Domain\Model\ModelReference;
use App\Content\Domain\Model\Content;

final class CreateCommentCommand implements Command
{
    public function __construct(
        private readonly string $description,
        private readonly ModelReference $author,
        private readonly Content $parent,
    ) {}

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthor(): ModelReference
    {
        return $this->author;
    }

    public function getParent(): Content
    {
        return $this->parent;
    }
}
