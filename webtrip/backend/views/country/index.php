<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'id_continent',
                'value'=>'continent.name',
                'label'=>'Continent'

            ],
            'name',
            [
                'attribute' => 'flag',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->flag!='')
                    return Html::img($model->flag,
                        ['width' => '50px']);
                    else return "no image";
                },
            ],
            'capital',
            'population',
            'cod',
            //'description:ntext',
            //'id_continent',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{Edit} {Delete}',
                'buttons' => [
                    'Edit' =>function ($url, $country) {
                        return Html::a('Edit', ['update', 'id' => $country->id_country], ['class' => 'btn btn-primary']);},
                    'Delete' =>function ($url, $country) {
                            return Html::a('Delete', ['block', 'id' => $country->id_country], ['class' => 'btn btn-danger']);

                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
