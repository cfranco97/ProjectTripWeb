<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\TripSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trip-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute'=>'id_country',
                'value'=>'country.name',
                'label' =>'Country'
            ],
            [
                'attribute'=>'id_user',
                'value'=>'user.username',
                'label'=>'User'
            ],
            [
                'attribute'=>'startdate',
                'label'=>'Start Date'
            ],
            [
                'attribute'=>'enddate',
                'label'=>'End Date'
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{Edit} {Delete}',
                'buttons' => [
                    'Edit' =>function ($url, $trip) {
                        return Html::a('Edit', ['update', 'id' => $trip->id_trip], ['class' => 'btn btn-primary']);},
                    'Delete' =>function ($url, $trip) {
                        return Html::a('Delete', ['delete', 'id' => $trip->id_trip], ['class' => 'btn btn-danger']);}

                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
