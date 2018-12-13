<?php
namespace backend\controllers;

use common\models\Country;
use common\models\Trip;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class TripController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','edit','delete'],
                'rules' => [
                    [
                        'actions' => [ 'index','edit','delete'],
                        'allow' => true,
                        'roles' => ['superAdmin'],
                    ],
                    [
                        'actions' => [ 'index','edit'],
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $trips = $this->allTrips();
        return $this->render('index', [
            'trips' => $trips,

        ]);
    }

    public function actionCreate(){

        $trip = new Trip();


        if($trip->load(Yii::$app->request->post()) && $trip->save()){
            return $this->redirect(['index']);
        }

        return $this->render('create', ['trip' => $trip]);
    }


    public function actionEdit(){

        $id_trip= Yii::$app->request->get('id_trip');
        $trip = Trip::find()->where(['id_trip' => $id_trip])->one();
        if ($trip->load(Yii::$app->request->post()) && $trip->save()) {
            return $this->redirect(['index']);
        }
        else{
            return $this->render('edit', [
                'trip' =>$trip,
            ]);}
    }

    public function actionDelete(){

        $id_trip= Yii::$app->request->get('id_trip');
        $trip = Trip::find()->where(['id_trip' => $id_trip])->one();
        $trip->delete();
        return $this->redirect(['index']);
    }

    public function allTrips(){
        $trips = Trip::find()->all();
        return $trips;
    }
}