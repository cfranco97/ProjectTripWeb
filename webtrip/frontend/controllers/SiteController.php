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

/**
 * Site controller
 */
class SiteController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

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

    public function actionCountryInformation(){
        $id_country = Yii::$app->request->get('id_country');
        $country = Country::find()->where(['id_country' => $id_country])->one();
        $reviews = Review::find()->where(['id_country' => $id_country])->orderBy(new Expression('rand()'))->limit(3)->all();
        return $this->render('country', [ 'country'=>$country,
            'reviews'=>$reviews]);
    }

    public function actionAdd(){


    $id_country = Yii::$app->request->get('id_country');
    $wish = new Wishlist();
    $wish->id_country = $id_country;
    $wish->id_user = Yii::$app->user->id;
        if(Wishlist::find()->where(['id_user' => Yii::$app->user->id])->andWhere(['id_country'=>$id_country])->one()==null) {
            $wish->save();
            Yii::$app->session->setFlash('success', "added to wishlist");

            return $this->redirect(['country-information','id_country'=>$id_country]);
        }
    else{
        Wishlist::find()->where(['id_user' => Yii::$app->user->id])->andWhere(['id_country'=>$id_country])->one()->delete();
        Yii::$app->session->setFlash('success', "Removed  from wishlist");

        return $this->redirect(['country-information','id_country'=>$id_country]);
        }
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
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
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
     * return all country from a continent
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
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }


//    protected function findModel($id)
//    {
//        if (($model = Country::findOne($id)) !== null) {
//            return $model;
//        }
//
//        throw new NotFoundHttpException('The requested page does not exist.');
//    }

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


//    public function actionTrip()
//    {
//        $id_country = Yii::$app->request->get('id_country');
//        $country = Country::find()->where(['id_country' => $id_country])->one();
//        $model = new TripForm();
//
//        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
//            $model->id_country=$id_country;
//            $model->id_user=Yii::$app->user->id;
//            if ($model->Trip()) {
//
//
//
//                $trips = $this->findTrips();
//
//
//                return $this->render('trips', [
//                    'trips'=> $trips
//
//                    ]);
//
//
//            }
//            return $this->refresh();
//        }else{
//        return $this->render('newtrip',[
//        'model' => $model,
//        'country' => $country]);
//        }
//    }
//
//    public function actionMytrips()
//    {
//        $trips = $this->findTrips();
//        return $this->render('trips', [
//            'trips'=> $trips]);
//    }

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
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }



    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function findUser(){
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        return $user;
    }

    public function findTrips(){
        $alltrips=Trip::find()->where(['id_user' =>  Yii::$app->user->id])->all();
        return $alltrips;

    }

    public function actionTop(){


        $query=Country::findBySql("SELECT country.flag, country.name,COUNT(trip.id_trip) AS numero FROM trip
LEFT JOIN country ON trip.id_country = country.id_country
GROUP BY name ORDER BY numero DESC    ")->all();

        $query2=Country::findBySql("SELECT country.flag, country.name,ROUND(AVG(review.rating), 1) AS averagerating FROM review
LEFT JOIN country ON review.id_country = country.id_country
GROUP BY name
ORDER BY averagerating desc")->all();

        return $this->render('top', [
            'query' => $query,
            'query2' =>$query2,
        ]);


    }
}
