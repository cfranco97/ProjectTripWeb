<?php namespace frontend\tests\functional\models;
use frontend\tests\FunctionalTester;

class AddToWishlistCest
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
    public function AddToWishlist(FunctionalTester $I)
    {
        //faz login
        $I->submitForm('#login-form', $this->formParams('carlos', '123456789'));
        $I->see('Choose a country');

        $I->submitForm($this->formCountry, [
            'CountryForm[continent]' => 'Europe',
            'CountryForm[country]' => '2',
        ]);

        $I->see('Capital: Madrid');

        $I->click('.addwish');

        $I->see('Added to wishlist');
    }
}
