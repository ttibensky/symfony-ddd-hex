<?php

declare(strict_types=1);

namespace App\Content\Domain\Query;

use App\Common\Domain\Bus\Query\QueryHandler;
use App\Content\Domain\Model\Content;
use App\Content\Domain\Repository\ContentRepository;

final class GetContentQueryHandler implements QueryHandler
{
    public function __construct(
        private ContentRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function __invoke(GetContentQuery $query): ?Content
    {
        return $this->repository->get($query->getId());
    }
}
