<?php

namespace api\modules\v1\controllers;

use common\models\Country;
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
    public function actionTopVisit(){


        $query=Country::findBySql("SELECT country.flag, country.name,COUNT(review.id_trip) AS numero FROM review
        LEFT JOIN country ON review.id_country = country.id_country
        GROUP BY name ORDER BY numero DESC    ")->all();

        return $query;
    }

    public function actionTopAvg(){

        $query2=Country::findBySql("SELECT country.flag, country.name,ROUND(AVG(review.rating), 1) AS averagerating FROM review
        LEFT JOIN country ON review.id_country = country.id_country
        GROUP BY name
        ORDER BY averagerating desc")->all();

        return $query2;
    }
}


