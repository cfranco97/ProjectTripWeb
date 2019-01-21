<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\ChangePassword;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionProfile()
    {
        $model= $this->findUser();
        return $this->render('profile', [
            'model' => $model,
        ]);

    }

    public function actionEdit()
    {
        $model= $this->findUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile']);
        }
        else{
        return $this->render('edit', [
            'model' =>$model,
        ]);}
    }
    public function actionChangePassword()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            return $this->goHome();
        }
        return $this->render('change-password', [
            'model' => $model,
        ]);
    }

    //
    public function findUser(){
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        return $user;
    }
}