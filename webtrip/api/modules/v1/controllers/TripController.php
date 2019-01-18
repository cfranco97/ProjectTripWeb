<?php

namespace api\modules\v1\controllers;

use common\models\Trip;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;


class TripController extends ActiveController
{
    public $modelClass = 'common\models\Trip';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }

    public function actionDone($id){
        $today = date('Y-m-d');
        $doneTrips=Trip::find()->where(['<','enddate',$today])->andWhere(['id_user'=>$id])->orderBy('startdate DESC')->all();
        return $doneTrips;
    }

    public function actionTodo($id){
        $today = date('Y-m-d');
        $todoTrips=Trip::find()->where(['>=','enddate',$today])->andWhere(['id_user'=>$id])->orderBy('enddate ASC')->all();
        return $todoTrips;
    }

    public function actionEdit($id){

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