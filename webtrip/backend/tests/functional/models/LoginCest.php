<?php
namespace backend\tests\functional\models;
use backend\tests\FunctionalTester;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    // tests
    public function checkEmpty(FunctionalTester $I)
    {
        $I->fillField('#loginform-username', '');

        $I->fillField('#loginform-password', '');

        $I->click('login-button');

        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function LoginAdmin(FunctionalTester $I)
    {
        $I->see('Please fill out the following fields to login:', 'p');

        $I->fillField('#loginform-username', 'admin');

        $I->fillField('#loginform-password', '123456789');

        $I->seeInField('#loginform-username','admin');

        $I->click('login-button');

        $I->dontSee('You are not allowed to perform this action.');

        $I->see('Search for users, update their information and block or unblock them from your website.');
    }

    public function LoginAsNormalUser(FunctionalTester $I)
    {

        $I->see('Please fill out the following fields to login:', 'p');

        $I->fillField('#loginform-username', 'carlos');

        $I->fillField('#loginform-password', '123456789');

        $I->click('login-button');

        $I->see('You are not allowed to perform this action.');

        $I->dontSee('Search for users, update their information and block or unblock them from your website.');
    }

    public function LoginError(FunctionalTester $I)
    {
        $I->see('Please fill out the following fields to login:', 'p');

        $I->fillField('#loginform-username', 'carlos');

        $I->fillField('#loginform-password', '123456');

        $I->click('login-button');

        $I->see('Incorrect username or password');
    }
}
