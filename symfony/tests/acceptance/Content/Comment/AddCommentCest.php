<?php

declare(strict_types=1);

namespace App\Tests\Acceptance\Content\Comment;

use App\Tests\AcceptanceTester;
use Faker\Factory;

class AddCommentCest
{
    public function tryCommentAdd(AcceptanceTester $I): void
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
