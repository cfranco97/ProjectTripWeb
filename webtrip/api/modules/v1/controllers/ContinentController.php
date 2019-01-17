<?php

namespace api\modules\v1\controllers;

use common\models\Country;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class ContinentController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Continent';

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

    public function actionGetCountries($id){

        $query1=Country::find()->where(['id_continent'=>$id])->all();

        return $query1;
    }
}