<?php

declare(strict_types=1);

namespace App\Content\Comment\Domain\Command;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Common\Domain\Bus\Event\EventBus;
use App\Content\Comment\Domain\Command\CreateCommentCommand;
use App\Content\Comment\Domain\Model\Comment;
use App\Content\Comment\Domain\Repository\CommentRepository;

final class CreateCommentCommandHandler implements CommandHandler
{
    public function __construct(
        private CommentRepository $repository,
        private EventBus $eventBus
    ) {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateCommentCommand $command): Comment
    {
        $comment = Comment::create(
            null,
            null,
            $command->getDescription(),
            $command->getAuthor(),
            $command->getParent(),
        );

        $this->repository->save($comment);

        $this->eventBus->publish(...$comment->pullEvents());

        return $comment;
    }
}
