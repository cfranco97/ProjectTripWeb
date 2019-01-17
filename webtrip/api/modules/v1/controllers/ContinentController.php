<?php

namespace api\modules\v1\controllers;

use common\models\Country;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


class ContinentController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Continent';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function actionGetCountries($id){

        $query1=Country::find()->where(['id_continent'=>$id])->all();

        return $query1;
    }
}