<?php
use backend\tests\FunctionalTester;

$I = new FunctionalTester($scenario);

$I->wantTo('Fail to Login as a normal User');

$I->amOnPage('index.php?r=site/login');

$I->see('Please fill out the following fields to login:', 'p');

$I->fillField('#loginform-username', 'carlos');

$I->fillField('#loginform-password', '123456789');

$I->click('login-button');

$I->see('You are not allowed to perform this action.');

$I->dontSee('Search for users, update their information and block or unblock them from your website.');
