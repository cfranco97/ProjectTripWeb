<?php
namespace frontend\tests\acceptance\models;
use frontend\tests\AcceptanceTester;

class SignupCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('index.php?r=site/signup');
    }

    // tests
    public function checkEmpty(AcceptanceTester $I)
    {
        $I->wantTo('Check if the the username or password fields are empty!');

        $I->fillField('#signupform-username', '');

        $I->fillField('#signupform-email', '');

        $I->fillField('#signupform-password', '');

        $I->click('signup-button');

        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
        $I->see('Email cannot be blank.');
    }

    public function Signup(AcceptanceTester $I)
    {
        $I->wantTo('Signup and load the next page successfully');

        $I->see('Please fill out the following fields to signup:', 'p');

        $I->fillField('#signupform-username', '');

        $I->fillField('#signupform-email', '');

        $I->fillField('#signupform-password', '');

        $I->selectOption('#signupform-id_country','Portugal');

        $I->click('signup-button');
    }
}
