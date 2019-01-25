<?php

use yii\helpers\Html;

?>
<h1><b>Your Trips</b></h1>

    <div class="container">

    </div>
<div class="container">

    <div class="col-lg-6">
        <h4>To do Trips</h4>
        <div class="list-group">
            <?php foreach ($todoTrips as $trip) {?>
                <div class="list-group-item" >

                    <h4 class="list-group-item-heading"><?= $trip->country->name?>
                        <?=  Html::img($trip->country->flag, ['width' => '30px']) ?></h4>
                    <p class="list-group-item-text"><?= $trip->startdate ?></p>
                    <p class="list-group-item-text"><?= $trip->enddate ?></p>
                    <br>
                    <?= Html::a('Trip information', ['trip/trip-information', 'id_trip'=>$trip->id_trip], ['class'=>'btn btn-primary']) ?>

                </div>
            <?php } ?>
        </div>
    </div>

    <div class="col-lg-6">
        <h4>Trips Done</h4>
        <div class="list-group">
            <?php foreach ($doneTrips as $trip) {?>
                <div class="list-group-item" >

                    <h4 class="list-group-item-heading"><?= $trip->country->name?>
                        <?=  Html::img($trip->country->flag, ['width' => '30px']) ?></h4>
                    <p class="list-group-item-text"><?= $trip->startdate ?></p>
                    <p class="list-group-item-text"><?= $trip->enddate ?></p>
                    <br>
                    <?= Html::a('Trip information', ['trip/trip-information', 'id_trip'=>$trip->id_trip], ['class'=>'btn btn-primary']) ?>

                </div>
            <?php } ?>
        </div>
    </div>

</div>
