<?php

use yii\grid\GridView;
use yii\helpers\html;
use yii\widgets\DetailView;

?>

<html lang="<?= Yii::$app->language ?>">

<h1>Top</h1>

<div class="container">

    <div class="col-lg-6">
        <h2>Countries</h2>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'id_trip',
                //['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

    <div class="col-lg-6">
        <h2>Continent</h2>
    </div>

</div>