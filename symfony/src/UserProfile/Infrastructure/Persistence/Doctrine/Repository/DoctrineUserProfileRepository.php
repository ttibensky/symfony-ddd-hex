<?php

declare(strict_types=1);

namespace App\UserProfile\Infrastructure\Persistence\Doctrine\Repository;

use App\Common\Infrastructure\Persistence\Doctrine\DoctrineRepository;
use App\UserProfile\Domain\Model\UserProfile;
use App\UserProfile\Domain\Repository\UserProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineUserProfileRepository extends DoctrineRepository implements UserProfileRepository
{
    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        parent::__construct($managerRegistry, $entityManager, UserProfile::class);
    }

    public function get(int $id): ?UserProfile
    {
        return $this->find($id);
    }

    public function getByEmail(string $email): ?UserProfile
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function save(UserProfile $userProfile): void
    {
        $this->persist($userProfile);
    }
}
