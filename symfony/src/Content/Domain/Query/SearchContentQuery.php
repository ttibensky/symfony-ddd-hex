<?php

declare(strict_types=1);

namespace App\Content\Domain\Query;

use App\Common\Domain\Bus\Query\Query;
use App\Content\Domain\Model\ContentSearch;

final class SearchContentQuery implements Query
{
    public function __construct(
        private readonly ContentSearch $contentSearch,
    ) {}

    public function getContentSearch(): ContentSearch
    {
        return $this->contentSearch;
    }
}
