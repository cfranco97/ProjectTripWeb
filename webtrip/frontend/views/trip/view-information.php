<?php

use kartik\date\DatePicker;
use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>

<div class="container">
    <div class="col-lg-6" >
    <h1><?= $trip->country->name?></h1>
    <p>You go on <?= $trip->startdate?></p>
    <p>Coming back on <?= $trip->enddate?></p>
    <h3>What you are going to do</h3>
    <p><?= $trip->notes?></p>

    <p>
    <?= Html::a('Delete this Trip',['delete','id_trip'=>$trip->id_trip],[
            'class'=>'btn btn-danger',
            'data'=>[
                    'confirm'=>'Are you sure you want to delete this?',
                    'method'=>'post',
                    ]
]) ?>
    </p>
    </div>
    <div class="col-lg-6" >
        <?php $form = ActiveForm::begin(['id' => 'rating-form']); ?>
        <?= $form->field($model, 'rating')->widget(StarRating::classname(), [
            'pluginOptions' => ['step' => 1]
        ]);
        ?>
        <?= $form->field($model, 'message')->textArea() ?>
        <?= Html::submitButton('Send your review', ['class' => 'btn btn-primary', 'name' => 'trip-button']) ?>
        <?php ActiveForm::end(); ?>
        <small>You can edit your review anytime</small>

    </div>

</div>