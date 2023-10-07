<?php

declare(strict_types=1);

namespace App\UserProfile\Infrastructure\Persistence\Doctrine\DataFixtures;

use App\UserProfile\Application\Service\CreateUserProfileService;
use App\UserProfile\Domain\Command\CreateUserProfileCommand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class UserProfileFixtures extends Fixture
{
    public const AMOUNT = 100;
    public const REF = 'user-profile-';
    private Generator $faker;

    public function __construct(
        private readonly CreateUserProfileService $createUserProfileService,
    ) {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= self::AMOUNT; $i++) {
            $userProfile = ($this->createUserProfileService)(new CreateUserProfileCommand(
                $this->faker->unique()->name(),
                $this->faker->unique()->email(),
            ));

            $this->addReference(self::REF . $i, $userProfile);
        }

        $manager->flush();
    }
}
