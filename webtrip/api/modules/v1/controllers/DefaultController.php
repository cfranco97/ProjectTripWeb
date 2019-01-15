<?php


namespace api\modules\v1\controllers;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;

class DefaultController extends ActiveController
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

    public function checkAccess($action, $model = null, $params = [])
    {
        if ( $action === 'delete' || $action === 'post' || $action === 'put') {
            if (\Yii::$app->user->isGuest)
            {
                throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s  if you are logged in.', $action));
            }
        }
    }

}