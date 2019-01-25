<?php
namespace frontend\tests\functional\models;

use frontend\tests\FunctionalTester;

class AboutCest
{
    public function checkAbout(FunctionalTester $I)
    {
        $I->amOnRoute('site/about');
        $I->see('About', 'h1');
        $I->see('This website is intended to people who wants to plan trips. They can check a variety of countries, check the most visited and the most rated.');

    }
}
