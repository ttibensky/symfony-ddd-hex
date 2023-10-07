<?php

declare(strict_types=1);

namespace App\Content\Domain\Command;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Common\Domain\Model\PagedList;
use App\Content\Domain\Command\SearchContentCommand;
use App\Content\Domain\Repository\ContentRepository;

final class SearchContentCommandHandler implements CommandHandler
{
    public function __construct(
        private ContentRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function __invoke(SearchContentCommand $command): PagedList
    {
        return $this->repository->search($command->getContentSearch());
    }
}
