<?php

namespace api\modules\v1\controllers;

use common\models\Trip;
use common\models\User;
use Yii;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use yii\web\Response;


class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';

    public function actionLogin()
    {
        $user = User::findByUsername(Yii::$app->request->post('username'));
        if($user->validatePassword(Yii::$app->request->post('password'))){
            return $user;
        }
        //return "wrong data inserted!";
        return [false];
    }

    public function actionSignup(){
        $user = new User();
        $user-> username = yii::$app->request->post('username');
        $user-> email = yii::$app->request->post('email');
        $user-> id_country = yii::$app->request->post('id_country');
        $user->setPassword(Yii::$app->request->post('password'));
        $user->generateAuthKey();
        if($user->validate()){
            //rbac
            $user->save();
            $auth = \Yii::$app->authManager;
            $userRole = $auth->getRole('user');
            $auth->assign($userRole,$user->getId());
            return $user;
        }
        return $user;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if($action === 'post'){
            if(!\Yii::$app->user->isGuest){
                throw new \yii\web\ForbiddenHttpException('tem que ser admin para fazer esta' .$action);
            }
        }
    }

    public function actionVisits($id){

        $data = Trip::find()->select('id_country')->where(['id_user'=>$id])->distinct()->count();
        return $data;
    }

    public function actionPercentage($id){

        $data = $this->actionVisits($id)/195;
        return $data;
    }
}