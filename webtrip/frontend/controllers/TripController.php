<?php
namespace frontend\controllers;

use app\models\Country;
use app\models\Review;
use frontend\models\ReviewForm;
use frontend\models\Trip;
use frontend\models\TripForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionTrip()
    {
    $id_country = Yii::$app->request->get('id_country');
    $country = Country::find()->where(['id_country' => $id_country])->one();
    $model = new TripForm();

    if ($model->load(Yii::$app->request->post())&& $model->validate()) {
        $model->id_country=$id_country;
        $model->id_user=Yii::$app->user->id;
        if ($model->saveTrip()) {

            $trips = $this->findTrips();

            return $this->redirect(['mytrips','trips'=>$trips]);
            }

    }else{
        return $this->render('create',[
            'model' => $model,
            'country' => $country]);
    }
}

    public function actionMytrips()
    {
        $trips = $this->findTrips();
        return $this->render('index', [
            'trips'=> $trips]);
    }

    public function actionTripInformation()
    {
        $id_trip = Yii::$app->request->get('id_trip');
        $trip = Trip::find()->where(['id_trip' => $id_trip])->one();
        $model = Review::find()->where(['id_trip' => $id_trip])->one();
        if ($model != null) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->render('view-information', [
                    'model' => $model,
                    'trip' => $trip]);
            } else {
                return $this->render('view-information', [
                    'model' => $model,
                    'trip' => $trip]);
            }
        } else {
            $model = new ReviewForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->id_user = Yii::$app->user->id;
                $model->id_trip = $id_trip;
                $model->id_country = $trip->id_country;
                if ($model->saveReview()) {

                    return $this->render('view-information', [
                        'trip' => $trip,
                        'model' => $model
                    ]);
                }
            } else {

                return $this->render('view-information', [
                    'trip' => $trip,
                    'model' => $model
                ]);
            }
        }

    }




    public function actionDelete(){
        $id_trip = Yii::$app->request->get('id_trip');
        Trip::find()->where(['id_trip' =>$id_trip])->one()->delete();
        return $this->goHome();
    }

    public function findTrips(){
        $alltrips=Trip::find()->where(['id_user' =>  Yii::$app->user->id])->all();
        return $alltrips;

    }
}