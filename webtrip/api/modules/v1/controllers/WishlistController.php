<?php

namespace api\modules\v1\controllers;

use common\models\Wishlist;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;

class WishlistController extends ActiveController
{
    public $modelClass = 'common\models\Wishlist';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return $behaviors;
    }
    
    public function actionByUser($id){
        $query = Wishlist::find()->where(['id_user'=>$id])->all();
        return $query;
    }

}