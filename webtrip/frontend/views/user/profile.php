<?php

use yii\helpers\Html;
use app\models\User;
use app\models\Country;

?>

<html lang="<?= Yii::$app->language ?>">

<h1>Profile</h1>
<div>
    <div class="container"
    <div class="row">
        <div class="col-lg-2" >
            Profile pic
        </div>

        <div class="col-lg-5" >


            <p><b>Username: </b><?= $user->username?></p>
            <p><b>Email: </b><?= $user->email?></p>
            <p><b>Country: </b> <?= $country->name?></p>
            <br>
            <?= Html::a('Edit Profile', ['edit', 'user'=>$user], ['class' => 'btn btn-primary']) ?>

        </div>

        <div class="col-lg-5" >
            <h3><b>X% World Visited</b></h3>
            <h3><b>X Countries Visited</b></h3>
            <br>
            <?= Html::a('Gallery', ['/site/gallery'], ['class'=>'btn btn-primary']) ?>
            <br>
            <br>
            <?= Html::a('New Trip', ['/site/trips'], ['class'=>'btn btn-primary']) ?>

        </div>

    </div>

</div>

