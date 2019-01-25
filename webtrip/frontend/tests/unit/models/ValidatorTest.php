<?php namespace frontend\tests\models;

use common\models\Trip;
use common\models\User;

class DatabaseTest extends \Codeception\Test\Unit
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
    public function testValidateUser()
    {
        $user = new User();
        $user->username = null;
        $this->assertFalse($user->validate(['username']));

        $user->username = 'ruben';
        $this->assertTrue($user->validate(['username']));

        $user->email = null;
        $this->assertFalse($user->validate(['email']));

        $user->email = 'ruben@mail.com';
        $this->assertTrue($user->validate(['email']));

        $user->id_country = 'qwertyuiop';
        $this->assertFalse($user->validate(['id_country']));

        $user->id_country = 1;
        $this->assertTrue($user->validate(['id_country']));
    }

    public function testeValidateTrip()
    {
        $trip = new Trip();

        $trip->startdate = '19-2-2020';
        $this->assertFalse($trip->validate(['startdate']));

        $trip->enddate = '19-04-2021';
        $this->assertFalse($trip->validate(['enddate']));

        $trip->id_country = 4;
        $this->assertTrue($trip->validate(['id_country']));

        $trip->id_country = 'qwerty';
        $this->assertFalse($trip->validate(['id_country']));

        $trip->id_user = 4;
        $this->assertTrue($trip->validate(['id_user']));

        $trip->id_user = 'qwerty';
        $this->assertFalse($trip->validate(['id_user']));
    }
}