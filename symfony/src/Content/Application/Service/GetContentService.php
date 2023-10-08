<?php

declare(strict_types=1);

namespace App\Content\Application\Service;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Content\Domain\Model\Content;
use App\Content\Domain\Query\GetContentQuery;
use App\Content\Domain\Query\GetContentQueryHandler;

final class GetContentService implements CommandHandler
{
    public function __construct(
        private readonly GetContentQueryHandler $queryHandler,
    ) {}

    public function __invoke(GetContentQuery $query): ?Content
    {
        return ($this->queryHandler)($query);
    }
}
