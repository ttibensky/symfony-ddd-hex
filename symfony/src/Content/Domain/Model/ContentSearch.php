<?php

declare(strict_types=1);

namespace App\Content\Domain\Model;

use App\Content\Domain\Model\Content;

final class ContentSearch
{
    public function __construct(
        private readonly array $types = [Content::TYPE_BLOG],
        private readonly ?int $limit = 10,
        private readonly ?int $offset = 0,
    ) {}

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
