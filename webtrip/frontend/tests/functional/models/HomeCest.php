<?php

namespace frontend\tests\functional\models;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('TripHelper');
        $I->seeLink('Top');
        $I->click('Top');
        $I->see('Top Rated');
    }
}