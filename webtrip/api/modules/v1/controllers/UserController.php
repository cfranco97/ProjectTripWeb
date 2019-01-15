<?php

namespace api\modules\v1\controllers;

use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;


class UserController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class'=>HttpBasicAuth::className(),
            'auth'=>function($username,$password){
                $user = \api\modules\v1\models\User::findByUsername($username);
                if($user && $user->validatePassword($password) ){
                    return $user;
                }
            }
        ];
        return $behaviors;
    }
}