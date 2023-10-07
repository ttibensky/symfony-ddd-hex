<?php

declare(strict_types=1);

namespace App\UserProfile\Domain\Command;

use App\Common\Domain\Bus\Command\Command;

final class CreateUserProfileCommand implements Command
{
    public function __construct(
        private string $name,
        private string $email,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
