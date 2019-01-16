<?php

namespace api\modules\v1\controllers;


use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class WishlistController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Wishlist';
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
        if ( $action === 'delete' || $action === 'post' || $action === 'put' || $action === 'get') {
            if (\Yii::$app->user->can("admin"))
            {
                throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s  if you are logged in as an Admin!.', $action));
            }
        }
    }
}