<?php

declare(strict_types=1);

namespace App\Content\Blog\Domain\Command;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Content\Blog\Domain\Model\Blog;
use App\Content\Blog\Domain\Repository\BlogRepository;

final class GetBlogCommandHandler implements CommandHandler
{
    public function __construct(
        private BlogRepository $repository,
    ) {
        $this->repository = $repository;
    }

    public function __invoke(GetBlogCommand $command): Blog
    {
        if (!($blog = $this->repository->get($command->getId()))) {
            throw new \Exception('Blog not found.'); // @TODO use custom exception
        }

        return $blog;
    }
}
