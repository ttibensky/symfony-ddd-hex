<?php

declare(strict_types=1);

namespace App\Content\Domain\Query;

use App\Common\Domain\Bus\Query\QueryHandler;
use App\Common\Domain\Model\PagedList;
use App\Content\Domain\Query\SearchContentQuery;
use App\Content\Domain\Repository\ContentRepository;

final class SearchContentQueryHandler implements QueryHandler
{
    public function __construct(
        private ContentRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function __invoke(SearchContentQuery $query): PagedList
    {
        return $this->repository->search($query->getContentSearch());
    }
}
