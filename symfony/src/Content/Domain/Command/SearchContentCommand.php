<?php

declare(strict_types=1);

namespace App\Content\Domain\Command;

use App\Common\Domain\Bus\Command\Command;
use App\Content\Domain\Model\ContentSearch;

final class SearchContentCommand implements Command
{
    public function __construct(
        private readonly ContentSearch $contentSearch,
    ) {}

    public function getContentSearch(): ContentSearch
    {
        return $this->contentSearch;
    }
}
