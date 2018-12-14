<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Trip */

$this->title = 'Editing '.$model->user->username.'´s trip to ' . $model->country->name;
$this->params['breadcrumbs'][] = ['label' => 'Trips', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_trip, 'url' => ['view', 'id' => $model->id_trip]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
