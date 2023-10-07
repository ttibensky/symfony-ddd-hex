<?php

declare(strict_types=1);

namespace App\Content\Application\Service;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Common\Domain\Model\PagedList;
use App\Content\Domain\Command\SearchContentCommand;
use App\Content\Domain\Command\SearchContentCommandHandler;
use App\Content\Domain\Model\ContentSearch;

final class SearchContentService implements CommandHandler
{
    public function __construct(
        private readonly SearchContentCommandHandler $commandHandler,
    ) {}

    public function __invoke(ContentSearch $contentSearch): PagedList
    {
        $command = new SearchContentCommand($contentSearch);

        return ($this->commandHandler)($command);
    }
}
