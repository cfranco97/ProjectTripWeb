<?php
namespace frontend\tests\acceptance\models;
use backend\tests\AcceptanceTester;

class LoginCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
    }

    // tests
    public function checkEmpty(AcceptanceTester $I)
    {
        $I->wantTo('Check if the the username or password fields are empty!');

        $I->fillField('#loginform-username', '');

        $I->fillField('#loginform-password', '');

        $I->click('login-button');

        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function LoginAdmin(AcceptanceTester $I)
    {
        $I->wantTo('Login as an admin and load the next page successfully');

        $I->see('Please fill out the following fields to login:', 'p');

        $I->fillField('#loginform-username', 'admin');

        $I->fillField('#loginform-password', '123456789');

        $I->seeInField('#loginform-username','admin');

        $I->click('login-button');

        $I->dontSee('You are not allowed to perform this action.');

        $I->see('Search for users, update their information and block or unblock them from your website.');
    }

    public function LoginAsNormalUser(AcceptanceTester $I)
    {
        $I->wantTo('Attempt to login as normal user and fail to do it.');

        $I->see('Please fill out the following fields to login:', 'p');

        $I->fillField('#loginform-username', 'carlos');

        $I->fillField('#loginform-password', '123456789');

        $I->click('login-button');

        $I->see('You are not allowed to perform this action.');

        $I->dontSee('Search for users, update their information and block or unblock them from your website.');
    }

    public function LoginError(AcceptanceTester $I)
    {
        $I->wantTo('Attempt to login with the wrong credentials.');

        $I->see('Please fill out the following fields to login:', 'p');

        $I->fillField('#loginform-username', 'carlos');

        $I->fillField('#loginform-password', '123456');

        $I->click('login-button');

        $I->see('Incorrect username or password');
    }

}
