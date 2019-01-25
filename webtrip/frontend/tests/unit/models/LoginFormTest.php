<?php
namespace frontend\tests\models;

use common\models\LoginForm;
use common\models\User;

class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testCorrectLogin()
    {
        $model = new LoginForm([
           'username' => 'carlos',
           'password' => '123456789',
        ]);

        $user = $model->getUsername();

        expect($user)->isInstanceOf('common\models\User');

        expect($user->username)->equals('carlos');
        expect($user->validatePassword('123456789'))->true();
    }
}