<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Command;

use App\Common\Domain\Bus\Command\Command;
use App\UserProfile\Domain\Model\UserProfile;

final class CreateBlogCommand implements Command
{
    public function __construct(
        private readonly string $title,
        private readonly string $description,
        private readonly UserProfile $author, // @TODO replace with common interface (reference interface?)
    ) {}

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthor(): UserProfile
    {
        return $this->author;
    }
}
