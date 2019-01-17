<?php

namespace api\modules\v1\controllers;

use api\modules\v1\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Response;


class UserController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';


    public function behaviors()
    {

        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class'=>HttpBasicAuth::className(),
            'auth'=>function($username,$password){
                Yii::$app->response->format = Response::FORMAT_JSON;//retorna em formato JSON
                $user = \api\modules\v1\models\User::findByUsername($username);
                if($user && $user->validatePassword($password) ){
                    return $user;

                }
            }
        ];
        return $behaviors;
    }



    public function actionLogin()
    {
        $user = User::findByUsername(Yii::$app->request->post('username'));
        if($user->validatePassword(Yii::$app->request->post('password'))){
            return $user;
        }
        return "wrong data inserted!";
        //return [false];
    }

    public function actionSignup(){
        $user = new User();

    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if($action === 'post'){
            if(!\Yii::$app->user->can('admin')){
                throw new \yii\web\ForbiddenHttpException('tem que ser admin para fazer esta' .$action);
            }
        }
    }

}