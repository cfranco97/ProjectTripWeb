<?php namespace frontend\tests\functional\models;
use frontend\tests\FunctionalTester;

class NewTripCest
{
    protected $formCountry = '#country-form';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }
    //parametros para o login
    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    // tests
    public function NewTrip(FunctionalTester $I)
    {
        //faz login
        $I->submitForm('#login-form', $this->formParams('carlos', '123456789'));
        $I->see('Choose a country');

        $I->submitForm($this->formCountry, [
            'CountryForm[continent]' => 'Europe',
            'CountryForm[country]' => '1',
        ]);

        $I->see('Capital: Lisbon');

        $I->click('Plan a trip to this country');

        $I->see('You are planing a trip to Portugal');

        $I->fillField('#tripform-startdate','2019-01-01');
        $I->fillField('#tripform-enddate','2019-10-20');
        $I->fillField('#tripform-notes','testeee');
        $I->click('trip-button');

        $I->see('Your Trips');
    }
}
