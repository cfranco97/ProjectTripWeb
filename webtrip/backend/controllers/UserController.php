<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' =>['index','update','block'],
                'rules' => [
                    [
                        'actions' => ['index','update','block'],
                        'allow' => true,
                        'roles' => ['superAdmin'],
                    ],
                    [
                        'actions' => ['index','update'],
                        'allow' => true,
                        'roles' => ['admin'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all Users
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 10];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates the selected User
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Changes made to ".$model->username. " saved");
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    /*
     * Blocks/unblocks the selected User
     */
    public function actionBlock($id)
    {
        $model = $this->findModel($id);
        if ($model->status == 10) {
            $model->status = 0;
            $model->save();
            Yii::$app->session->setFlash('success', $model->username." blocked");
            return $this->redirect(['index']);
        }
        else{
            $model->status=10;
            $model->save();
            Yii::$app->session->setFlash('success', $model->username." unblocked");
            return $this->redirect(['index']);
        }
    }

    /*
     * Finds the selected User
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
