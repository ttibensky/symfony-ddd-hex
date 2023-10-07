<?php

declare(strict_types=1);

namespace App\UserProfile\Domain\Repository;

use App\UserProfile\Domain\Model\UserProfile;

interface UserProfileRepository
{
    public function get(int $id): ?UserProfile;
    public function save(UserProfile $userProfile): int;
    public function getByEmail(string $email): ?UserProfile;
}
