<?php

declare(strict_types=1);

namespace App\Content\Application\Service;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Common\Domain\Model\PagedList;
use App\Content\Domain\Query\SearchContentQuery;
use App\Content\Domain\Query\SearchContentQueryHandler;
use App\Content\Domain\Model\ContentSearch;

final class SearchContentService implements CommandHandler
{
    public function __construct(
        private readonly SearchContentQueryHandler $queryHandler,
    ) {}

    public function __invoke(ContentSearch $contentSearch): PagedList
    {
        $query = new SearchContentQuery($contentSearch);

        return ($this->queryHandler)($query);
    }
}
