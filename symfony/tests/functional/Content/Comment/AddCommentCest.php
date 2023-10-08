<?php

declare(strict_types=1);

namespace App\Tests\Functional\Content\Comment;

use App\Tests\FunctionalTester;
use Faker\Factory;

class AddCommentCest
{
    protected FunctionalTester $tester;

    public function tryCommentAdd(FunctionalTester $I): void
    {
        $faker = Factory::create();

        $description = implode(' ', $faker->sentences(rand(1, 5)));

        $I->amOnPage('/en/feed');
        $I->see('Welcome to lorem ipsum blogs', 'h1');
        $I->click(['css' => 'table a']);
        $I->click('Add new comment');
        
        $I->fillField('Body', $description);
        $I->click('Submit');
        $I->see($description, 'p');
    }
}
