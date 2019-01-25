<?php

use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$today = date("YYYY-mm-dd");

?>

<div class="container">
    <div class="col-lg-6" >
    <h1><?= Html::encode($trip->country->name);?>  <?=  Html::img($trip->country->flag, ['width' => '50px']); ?></h1>
    <?php if($today < $trip->startdate){ ?><p>You go on <?= $trip->startdate?></p> <?php ;}else{?> <p>You went on <?= $trip->startdate?></p><?php ;}?>
    <?php if($today > $trip->enddate){ ?><p>Coming back on <?= $trip->enddate?></p> <?php ;}else{?> <p>You came back on <?= $trip->enddate?></p><?php ;}?>
    <?php if($today > $trip->enddate){ ?><h3>What you are going to do</h3> <?php ;}else{?> <h3>What you did </h3><?php ;}?>
    <p><?= $trip->notes?></p>


    <p>
        <?= Html::a('Edit this trip', ['edit','id_trip'=>$trip->id_trip], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete this Trip',['delete','id_trip'=>$trip->id_trip],[
            'class'=>'btn btn-danger',
            'data'=>[
                    'confirm'=>'Are you sure you want to delete this?',
                    'method'=>'post',
                    ]
        ])
        ?>
    </p>
    </div>
    <div class="col-lg-6" >
        <?php $form = ActiveForm::begin(['id' => 'rating-form']); ?>
        <?= $form->field($model, 'rating')->widget(StarRating::classname(), [
            'pluginOptions' => ['step' => 0,5]
        ]);
        ?>
        <?= $form->field($model, 'message')->textArea() ?>
        <?= Html::submitButton('Send your review', ['class' => 'btn btn-primary', 'name' => 'review-button']) ?>
        <?php ActiveForm::end(); ?>
        <small>You can edit your review anytime</small>

    </div>

</div>