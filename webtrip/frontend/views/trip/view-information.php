<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>

<div class="container">
    <h1><?= $trip->country->name?></h1>
    <p>You go on <?= $trip->startdate?></p>
    <p>Coming back on <?= $trip->enddate?></p>
    <h3>What you are going to do</h3>
    <p><?= $trip->notes?></p>

    <p>
    <?= Html::a('Delete this Trap',['delete','id_trip'=>$trip->id_trip],[
            'class'=>'btn btn-danger',
            'data'=>[
                    'confirm'=>'YE YOU TWAHNT DELETE THAT?',
                    'method'=>'post',
                    ]
]) ?>
    </p>

</div>