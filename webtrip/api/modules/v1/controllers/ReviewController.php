<?php

namespace api\modules\v1\controllers;


use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


class ReviewController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Review';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }
}