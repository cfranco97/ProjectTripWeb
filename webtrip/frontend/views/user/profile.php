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


            <p>Username: <?= $user->username?></p>
            <p>Email: <?= $user->email?></p>
            <p>Country: <?= $country->name?></p>
            <br>
            <?= Html::a('Edit Profile', ['edit', 'user'=>$user], ['class' => 'btn btn-primary']) ?>

        </div>

        <div class="col-lg-5" >
            <p>X% World Visited</p>
            <h3>X Countries Visited</h3>
            <br>
            <?= Html::a('Gallery', ['/site/gallery'], ['class'=>'btn btn-primary']) ?>
            <br>
            <br>
            <?= Html::a('New Trip', ['/site/trips'], ['class'=>'btn btn-primary']) ?>

        </div>

    </div>

</div>

