<?php
namespace frontend\tests\unit\models;

use common\fixtures\UserFixture;
use common\models\SignupForm;

class SignupFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;


    public function _before()
    {

    }

    public function CorrectSignup()
    {
        $model = new SignupForm([
            'username' => 'test_username',
            'email' => 'test_email@example.com',
            'password' => 'test_password',
            'id_country' => '1',

        ]);

        $user = $model->signup();

        expect($user)->isInstanceOf('common\models\User');

        expect($user->username)->equals('test_username');
        expect($user->email)->equals('test_email@example.com');
        expect($user->validatePassword('test_password'))->true();
    }

    public function SignupError()
    {
        $model = new SignupForm([
            'username' => 'carlos',
            'email' => 'carlos@mail.com',
            'password' => 'test_password',
        ]);

        expect_not($model->signup());
        expect_that($model->getErrors('username'));
        expect_that($model->getErrors('email'));

        expect($model->getFirstError('username'))
            ->equals('This username has already been taken.');
        expect($model->getFirstError('email'))
            ->equals('This email address has already been taken.');
    }
}
