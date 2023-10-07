<?php

declare(strict_types=1);

namespace App\Content\Blog\Application\Service;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Content\Blog\Domain\Command\GetBlogCommand;
use App\Content\Blog\Domain\Command\GetBlogCommandHandler;
use App\Content\Blog\Domain\Model\Blog;

final class GetBlogService implements CommandHandler
{
    public function __construct(
        private readonly GetBlogCommandHandler $commandHandler,
    ) {}

    public function __invoke(int $id): Blog
    {
        $command = new GetBlogCommand($id);

        return ($this->commandHandler)($command);
    }
}
