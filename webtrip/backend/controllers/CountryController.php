<?php
namespace backend\controllers;

use common\models\Country;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class CountryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','edit','delete'],
                'rules' => [
                    [
                        'actions' => [ 'index','edit','create','delete'],
                        'allow' => true,
                        'roles' => ['superAdmin'],
                    ],
                    [
                        'actions' => [ 'index','edit','create'],
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

        $countries = $this->allCountries();
        return $this->render('index', [
            'countries' => $countries,

        ]);
    }

    public function actionCreate(){

        $country = new Country();


        if($country->load(Yii::$app->request->post()) && $country->save()){
            return $this->redirect(['index']);
        }

        return $this->render('create', ['country' => $country]);
    }


    public function actionEdit(){

        $id_country= Yii::$app->request->get('id_country');
        $country = Country::find()->where(['id_country' => $id_country])->one();
        if ($country->load(Yii::$app->request->post()) && $country->save()) {
            return $this->redirect(['index']);
        }
        else{
            return $this->render('edit', [
                'country' =>$country,
            ]);}
    }

    public function actionDelete(){

        $id_country= Yii::$app->request->get('id_country');
        $country = Country::find()->where(['id_country' => $id_country])->one();
        $country->delete();
        return $this->redirect(['index']);
    }

    public function allCountries(){
        $countries = Country::find()->all();
        return $countries;
    }
}