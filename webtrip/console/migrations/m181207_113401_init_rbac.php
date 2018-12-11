<?php

use yii\db\Migration;

/**
 * Class m181207_113401_init_rbac
 */
class m181207_113401_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;


        //create role User
        $user = $auth->createRole("user");
        $auth->add($user);

        //create role Admin
        $admin = $auth->createRole("admin");
        $auth->add($admin);

        //create role superAdmin
        $superAdmin = $auth->createRole("superAdmin");
        $auth->add($superAdmin);

        $auth->assign($superAdmin,1);
        $auth->assign($admin,2);
        $auth->assign($user,4);
        $auth->assign($user,5);
        $auth->assign($user,6);
        $auth->assign($user,7);
        $auth->assign($user,8);
        $auth->assign($user,9);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181207_113401_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181207_113401_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
