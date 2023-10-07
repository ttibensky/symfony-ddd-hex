<?php

declare(strict_types=1);

namespace App\Content\Blog\Application\Service;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Content\Blog\Domain\Command\CreateBlogCommand;
use App\Content\Blog\Domain\Command\CreateBlogCommandHandler;
use App\Content\Blog\Domain\Model\Blog;

final class CreateBlogService implements CommandHandler
{
    public function __construct(
        private readonly CreateBlogCommandHandler $commandHandler,
    ) {}

    public function __invoke(CreateBlogCommand $command): Blog
    {
        return ($this->commandHandler)($command);
    }
}
