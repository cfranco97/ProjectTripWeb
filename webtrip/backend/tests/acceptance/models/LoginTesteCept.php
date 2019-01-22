<?php use backend\tests\AcceptanceTester;

$I = new AcceptanceTester($scenario);

$I->wantTo('login as admin');

$I->amOnPage('index.php?r=site/login');

$I->see('Please fill out the following fields to login:', 'p');

$I->fillField('#loginform-username', 'admin');

$I->fillField('#loginform-password', '123456789');

$I->click('login-button');

$I->amOnPage('index.php');

$I->seeLink('Home');

$I->see('Search for users, update their information and block or unblock them from your website.');


