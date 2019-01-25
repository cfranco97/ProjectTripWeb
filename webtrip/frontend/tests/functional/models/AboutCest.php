<?php
namespace frontend\tests\functional\models;

use frontend\tests\FunctionalTester;

class AboutCest
{
    public function checkAbout(FunctionalTester $I)
    {
        $I->amOnRoute('site/about');
        $I->see('About', 'h1');
        $I->see('Those stats can be checked by any user to see what are the most visited countries and those with the most rating.
        This website is completely free');

    }
}
