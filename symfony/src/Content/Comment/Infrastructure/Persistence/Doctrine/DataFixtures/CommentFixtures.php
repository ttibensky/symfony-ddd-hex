<?php

declare(strict_types=1);

namespace App\Content\Comment\Infrastructure\Persistence\Doctrine\DataFixtures;

use App\Content\Comment\Application\Service\CreateCommentService;
use App\Content\Blog\Infrastructure\Persistence\Doctrine\DataFixtures\BlogFixtures;
use App\Content\Comment\Domain\Command\CreateCommentCommand;
use App\UserProfile\Infrastructure\Persistence\Doctrine\DataFixtures\UserProfileFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public const AMOUNT = 1000;
    public const REF = 'content-comment-';
    private Generator $faker;

    public function __construct(
        private readonly CreateCommentService $createCommentService
    ) {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= self::AMOUNT; $i++) {
            $author = $this->getReference(UserProfileFixtures::REF.rand(1, UserProfileFixtures::AMOUNT));
            $blog = $this->getReference(BlogFixtures::REF.rand(1, BlogFixtures::AMOUNT));

            // @TODO only flush at the end, maybe batch command handler that can delay event publishing?
            $comment = ($this->createCommentService)(new CreateCommentCommand(
                implode(' ', $this->faker->sentences(rand(1, 5))),
                $author,
                $blog,
            ));

            $this->addReference(self::REF.$i, $comment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserProfileFixtures::class,
            BlogFixtures::class,
        ];
    }
}
