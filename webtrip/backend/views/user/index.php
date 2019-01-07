  <?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'username',
            'email',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{Edit} {Block}',
                'buttons' => [
                        'Edit' =>function ($url, $user) {
                            return Html::a('Edit', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']);},
                        'Block' =>function ($url, $user) {
                            if ($user->status==0){
                                return Html::a('Unblock', ['block', 'id' => $user->id], ['class' => 'btn btn-danger']);
                            }
                            else {
                                return Html::a('Block', ['block', 'id' => $user->id], ['class' => 'btn btn-danger']);
                            }
                        }
            ],
        ],
    ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
