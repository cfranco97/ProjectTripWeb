<?php
namespace frontend\controllers;


use common\models\Country;
use common\models\Review;
use common\models\User;
use common\models\Wishlist;
use frontend\models\CountryForm;
use common\models\Trip;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Expression;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use common\models\SignupForm;
use frontend\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','get-started','index','signup','country-information','top','profile','wishlist','gallery','about'],
                'rules' => [
                    [
                        'actions' => ['signup','index','top','about'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','get-started','country-information','index','top','profile','wishlist','gallery','about'],
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

    /*
     * Displays the form to choose a country
     */

    public function actionIndex(){

        if(Yii::$app->user->isGuest){
            return $this->redirect(['welcome']);
        }
        $model = new CountryForm();
        if ($model->load(Yii::$app->request->post())) {
            $country=Country::find()->where(['id_country'=>$model->country])->one();
            $reviews=Review::find()->where(['id_country'=>$country->id_country])->orderBy(new Expression('rand()'))->limit(3)->all();
            return $this->render('country', [ 'country'=>$country,
                'reviews'=>$reviews]);
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }

    /*
     * Renders the welcome page
     * Has login and signup
     */
    public function actionWelcome()
    {
        $modelLogin = new LoginForm();
        $modelRegister = new SignupForm();


        if ($modelRegister->load(Yii::$app->request->post())) {
            if ($user = $modelRegister->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['index']);
                }
            }
        }
        if ($modelLogin->load(Yii::$app->request->post()) && $modelLogin->login()) {
            return $this->redirect(['index']);
        } else {


            return $this->render('welcome', [
                'modelRegister' => $modelRegister,
                'modelLogin' => $modelLogin,
            ]);

        }

    }
    /*
     * Renders the view with information about a country
     */
    public function actionCountryInformation(){
        $id_country = Yii::$app->request->get('id_country');
        $country = Country::find()->where(['id_country' => $id_country])->one();
        $reviews = Review::find()->where(['id_country' => $id_country])->orderBy(new Expression('rand()'))->limit(3)->all();
        return $this->render('country', [ 'country'=>$country,
            'reviews'=>$reviews]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['index']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionAdd(){

        $id_country = Yii::$app->request->get('id_country');
        $wish = new Wishlist();
        $wish->id_country = $id_country;
        $wish->id_user = Yii::$app->user->id;
        if(Wishlist::find()->where(['id_user' => Yii::$app->user->id])->andWhere(['id_country'=>$id_country])->one()==null) {
            $wish->save();
            Yii::$app->session->setFlash('success', "Added to wishlist");

            return $this->redirect(['country-information', 'id_country' => $id_country]);
        }
        else{
            Wishlist::find()->where(['id_user' => Yii::$app->user->id])->andWhere(['id_country'=>$id_country])->one()->delete();
            Yii::$app->session->setFlash('success', "Removed from wishlist");

            return $this->redirect(['country-information', 'id_country' => $id_country]);


        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     *
     * return all countrys from a continent
     */

    public function actionSubcat() {


            if (isset($_POST['depdrop_parents'])) {
                $parents = $_POST['depdrop_parents'];

                if ($parents != null) {
                    $cat_id = $parents[0];
                    $out = Country::getCountry($cat_id);
                    echo Json::encode(['output' => $out, 'selected' => '']);
                    return;
                }
            }
            echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Displays pages.
     *
     * @return mixed
     */
    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionWishlist()
    {
        return $this->render('wishlist');
    }


    public function actionGallery()
    {
        return $this->render('gallery');
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionEditProfile()
    {
        return $this->render('editProfile');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /*
     * Finds the current logged user
     */
    public function findUser(){
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        return $user;
    }

    /*
     * Finds all trips from the current user
     */
    public function findTrips(){
        $alltrips=Trip::find()->where(['id_user' =>  Yii::$app->user->id])->all();
        return $alltrips;

    }

    public function actionTop(){
        $topvisited=Country::findBySql("SELECT country.flag, country.name,COUNT(trip.id_trip) AS numero FROM trip
LEFT JOIN country ON trip.id_country = country.id_country
GROUP BY name ORDER BY numero DESC  LIMIT 10  ")->all();

        $toprated=Country::findBySql("SELECT country.flag, country.name,ROUND(AVG(review.rating), 1) AS averagerating FROM review
LEFT JOIN country ON review.id_country = country.id_country
GROUP BY name
ORDER BY averagerating DESC LIMIT 10")->all();

        return $this->render('top', [
            'toprated' => $toprated,
            'topvisited' =>$topvisited,
        ]);
    }
}
