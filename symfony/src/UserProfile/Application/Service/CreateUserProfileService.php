<?php

declare(strict_types=1);

namespace App\UserProfile\Application\Service;

use App\Common\Domain\Bus\Command\CommandHandler;
use App\UserProfile\Domain\Command\CreateUserProfileCommand;
use App\UserProfile\Domain\Command\CreateUserProfileCommandHandler;
use App\UserProfile\Domain\Model\UserProfile;

final class CreateUserProfileService implements CommandHandler
{
    public function __construct(
        private readonly CreateUserProfileCommandHandler $commandHandler,
    ) {}

    public function __invoke(CreateUserProfileCommand $command): UserProfile
    {
        return ($this->commandHandler)($command);
    }
}
