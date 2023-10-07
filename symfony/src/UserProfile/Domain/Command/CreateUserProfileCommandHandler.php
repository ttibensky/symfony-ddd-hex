<?php

declare(strict_types=1);

namespace App\UserProfile\Domain\Command;
use App\Common\Domain\Bus\Command\CommandHandler;
use App\Common\Domain\Bus\Event\EventBus;
use App\UserProfile\Domain\Model\UserProfile;
use App\UserProfile\Domain\Repository\UserProfileRepository;

final class CreateUserProfileCommandHandler implements CommandHandler
{
    public function __construct(
        private UserProfileRepository $repository,
        private EventBus $eventBus
    ) {
        $this->repository = $repository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateUserProfileCommand $command): UserProfile
    {
        // @TODO ensure the profile does not exist already
        
        $userProfile = UserProfile::create(
            null,
            $command->getName(),
            $command->getEmail(),
        );

        $this->repository->save($userProfile);

        $this->eventBus->publish(...$userProfile->pullEvents());

        return $userProfile;
    }
}
