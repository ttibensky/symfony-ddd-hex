<?php

declare(strict_types=1);

namespace App\Content\Blog\Infrastructure\Persistence\Doctrine\DataFixtures;

use App\Content\Blog\Application\Service\CreateBlogService;
use App\Content\Blog\Domain\Command\CreateBlogCommand;
use App\UserProfile\Infrastructure\Persistence\Doctrine\DataFixtures\UserProfileFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class BlogFixtures extends Fixture implements DependentFixtureInterface
{
    public const AMOUNT = 1000;
    public const REF = 'content-blog-';
    private Generator $faker;

    public function __construct(
        private readonly CreateBlogService $createBlogService
    ) {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= self::AMOUNT; $i++) {
            $author = $this->getReference(UserProfileFixtures::REF.rand(1, UserProfileFixtures::AMOUNT));

            // @TODO only flush at the end, maybe batch command handler that can delay event publishing?
            $blog = ($this->createBlogService)(new CreateBlogCommand(
                $this->faker->sentence(rand(5, 10)),
                implode(' ', $this->faker->sentences(rand(50, 100))),
                $author,
            ));

            $this->addReference(self::REF.$i, $blog);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserProfileFixtures::class,
        ];
    }
}
