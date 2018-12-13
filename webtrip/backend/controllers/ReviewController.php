<?php
namespace backend\controllers;

use common\models\Review;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * Site controller
 */
class ReviewController extends Controller
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

        $reviews = $this->allReviews();
        return $this->render('index', [
            'reviews' => $reviews,

        ]);
    }


    public function actionEdit(){

        $id_review= Yii::$app->request->get('id_review');
        $review = Review::find()->where(['id_review' => $id_review])->one();
        if ($review->load(Yii::$app->request->post()) && $review->save()) {
            return $this->redirect(['index']);
        }
        else{
            return $this->render('edit', [
                'review' =>$review,
            ]);}
    }

    public function actionDelete(){

        $id_review= Yii::$app->request->get('id_review');
        $review = Review::find()->where(['id_review' => $id_review])->one();
        $review->delete();
        return $this->redirect(['index']);
    }

    public function allReviews(){
        $reviews = Review::find()->all();
        return $reviews;
    }
}