<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Command;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Common\Domain\Bus\Event\EventBus;
use App\Content\Blog\Domain\Model\Blog;
use App\Content\Blog\Domain\Repository\BlogRepository;

final class CreateBlogCommandHandler implements CommandHandler
{
    public function __construct(
        private BlogRepository $repository,
        private EventBus $eventBus
    ) {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateBlogCommand $command): Blog
    {
        $blog = Blog::create(
            null,
            $command->getTitle(),
            $command->getDescription(),
            $command->getAuthor(),
        );

        $this->repository->save($blog);

        $this->eventBus->publish(...$blog->pullEvents());

        return $blog;
    }
}
