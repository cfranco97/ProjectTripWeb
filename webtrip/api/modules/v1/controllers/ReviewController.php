<?php

namespace api\modules\v1\controllers;


use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


class ReviewController extends ActiveController
{
    public $modelClass = 'common\models\Review';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }
}