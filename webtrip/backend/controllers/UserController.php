<?php
namespace backend\controllers;

use common\models\User;
use common\models\UserSearch;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
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
                'only' =>['index','edit','block'],
                'rules' => [
                    [
                        'actions' => ['index','edit','block'],
                        'allow' => true,
                        'roles' => ['superAdmin'],
                    ],
                    [
                        'actions' => ['index','edit'],
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

//        $searchModel = new UserSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);

        $users = $this->allUsers();
        return $this->render('index', [
            'users' => $users,

        ]);
    }

    public function actionEdit(){

        $id= Yii::$app->request->get('id');
        $user = User::find()->where(['id' => $id])->one();
        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            return $this->redirect(['index']);
        }
        else{
            return $this->render('edit', [
                'user' =>$user,
            ]);}
    }

    public function actionBlock()
    {

        $id = Yii::$app->request->get('id');
        $user = User::find()->where(['id' => $id])->one();
        if ($user->status == 10) {
            $user->status = 0;
            $user->save();
            Yii::$app->session->setFlash('success', "User Blocked");
            return $this->redirect(['index']);
        }
        else{
            $user->status=10;
            $user->save();
            Yii::$app->session->setFlash('success', "User UnBlocked");
            return $this->redirect(['index']);
        }
    }
    public function allUsers(){
        $users = User::find()->all();
        return $users;
    }
}
