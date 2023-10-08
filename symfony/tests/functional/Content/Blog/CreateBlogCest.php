<?php

declare(strict_types=1);

namespace App\Tests\Functional\Content\Blog;

use App\Tests\FunctionalTester;
use Faker\Factory;

class CreateBlogCest
{
    protected FunctionalTester $tester;

    public function tryCreateBlog(FunctionalTester $I): void
    {
        $faker = Factory::create();

        $title = $faker->sentence(rand(5, 10));
        $description = implode(' ', $faker->sentences(rand(50, 100)));

        $I->amOnPage('/en/feed');
        $I->see('Welcome to lorem ipsum blogs', 'h1');
        $I->click('Create new blog');

        $I->fillField('Title', $title);
        $I->fillField('Body', $description);
        $I->click('Submit');
        $I->see($title, 'h1');
        $I->see($description, 'p');

        $I->click('Home');
        $I->see($title, 'h2');
    }
}
