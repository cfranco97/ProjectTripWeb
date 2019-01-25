<?php

namespace frontend\tests\models;

use common\models\User;

class ValidatePasswordTest extends \Codeception\Test\Unit
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
    public function testValidatePassword()
    {
        //valida a password do user 11.
        $user = User::find()->where(['id'=> 11])->one();
        $this->assertTrue($user->validatePassword('123456789'));

        $this->assertFalse($user->validatePassword('qwertyuiop'));
    }
}