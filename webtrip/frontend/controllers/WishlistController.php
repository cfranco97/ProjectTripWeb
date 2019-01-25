<?php
namespace frontend\controllers;

use common\models\Country;
use common\models\Review;
use common\models\Wishlist;
use Yii;
use yii\db\Expression;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class WishlistController extends Controller
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

    public function actionIndex(){

        $wishlist = Wishlist::find()->where(['id_user' => Yii::$app->user->id])->all();
        return $this->render('index', [
            'wishlist' => $wishlist,
        ]);

    }

    public function actionAdd(){


        $id_country = Yii::$app->request->get('id_country');
        $wish = new Wishlist();
        $wish->id_country = $id_country;
        $wish->id_user = Yii::$app->user->id;
        $country = Country::find()->where(['id_country' => $id_country])->one();
        $reviews = Review::find()->where(['id_country' => $id_country])->orderBy(new Expression('rand()'))->limit(3)->all();
        if(Wishlist::find()->where(['id_user' => Yii::$app->user->id])->andWhere(['id_country'=>$id_country])->one()==null) {
            $wish->save();
            Yii::$app->session->setFlash('success', $country->name." added to wishlist");

            return $this->render('site/country', ['country' => $country,
                'reviews' => $reviews]);
        }
        else{
            Wishlist::find()->where(['id_user' => Yii::$app->user->id])->andWhere(['id_country'=>$id_country])->one()->delete();
            Yii::$app->session->setFlash('success', "Removed ".$country->name." from wishlist");

            return $this->render('site/country', ['country' => $country,
                'reviews' => $reviews]);


        }
    }

    public function actionDelete()
    {
        $id_wishlist = Yii::$app->request->get('id_wishlist');
        Wishlist::find()->where(['id_wishlist' => $id_wishlist])->one()->delete();
        return $this->redirect(['index']);
    }
}