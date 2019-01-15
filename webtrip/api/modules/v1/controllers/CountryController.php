<?php

namespace api\modules\v1\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class CountryController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Country';

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
}


