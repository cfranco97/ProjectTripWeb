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
