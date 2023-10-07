<?php

declare(strict_types=1);

namespace App\Content\Comment\Application\Service;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\Content\Comment\Domain\Command\CreateCommentCommandHandler;
use App\Content\Comment\Domain\Command\CreateCommentCommand;
use App\Content\Comment\Domain\Model\Comment;

final class CreateCommentService implements CommandHandler
{
    public function __construct(
        private readonly CreateCommentCommandHandler $commandHandler,
    ) {}

    public function __invoke(CreateCommentCommand $command): Comment
    {
        return ($this->commandHandler)($command);
    }
}
