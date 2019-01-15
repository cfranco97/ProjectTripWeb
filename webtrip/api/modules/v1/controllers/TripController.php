<?php

namespace api\modules\v1\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class TripController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Trip';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
          'class'=>CompositeAuth::className(),
          'authMethods'=>[
              HttpBearerAuth::className(),
          ],
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