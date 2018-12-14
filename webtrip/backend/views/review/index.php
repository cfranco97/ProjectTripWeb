<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id_country',
                'value'=>'country.name',
                'label'=>'Country'
            ],
            [
                'attribute'=>'id_user',
                'value'=>'user.username',
                'label'=>'User'
            ],
            'rating',
            'message',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{Delete}',
                'buttons' => [
                    'Delete' =>function ($url, $review) {
                        return Html::a('Delete', ['delete', 'id' => $review->id_review], ['class' => 'btn btn-danger']);

                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
