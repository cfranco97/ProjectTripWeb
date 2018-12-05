<?php

use yii\db\Migration;

/**
 * Class m181203_122814_init_rbac
 */
class m181203_122814_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "createUser" permission
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Create a User';
        $auth->add($createUser);

        // add "updateUser" permission
        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Update a Users Profile';
        $auth->add($updateUser);

        // add "user" role and give this role the "createUser" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createUser);

        // add "admin" role and give this role the "updateUser" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $user);

        $god = $auth->createRole('god');
        $auth->add($god);
        $auth->addChild($god, $admin);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($user, 2);
        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181203_122814_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
