<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\ChangePassword;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * UserController
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile','edit','change-password'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['profile','edit','change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /*
     * Renders the view with profile information
     */
    public function actionProfile()
    {
        $model= $this->findUser();
        return $this->render('profile', [
            'model' => $model,
        ]);

    }

    /*
     * updates the logged user
     */

    public function actionEdit()
    {
        $model= $this->findUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Information updated");
            return $this->redirect(['profile']);
        }
        else{
        return $this->render('edit', [
            'model' =>$model,
        ]);}
    }

    /*
     * changes the password of the logged user
     */
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

    /*
     * finds the current logged user
     */
    public function findUser(){
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        return $user;
    }
}