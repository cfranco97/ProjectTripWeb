<?php

use yii\helpers\Html;

?>

<html lang="<?= Yii::$app->language ?>">

<h1>Profile</h1>
<div>
    <div class="container"
    <div class="row">
        <div class="col-lg-6" >
            <p><b>Username: </b><?= $model->username?></p>
            <p><b>Email: </b><?= $model->email?></p>
            <p><b>Country: </b> <?php if($model->country !=null){echo  $model->country->name;}else { echo "oof";}?></p>
            <br>
            <?= Html::a('Edit Profile', ['edit'], ['class' => 'btn btn-primary']) ?>

        </div>
        <div class="col-lg-6" >
            <h3><b><?=round($model->percentageWorld,2)?>% World Visited</b></h3>
            <h3><b><?= $model->countriesVisited?> Countries Visited</b></h3>
            <br>
            <?= Html::a('Gallery', ['/site/gallery'], ['class'=>'btn btn-primary']) ?>

        </div>

    </div>

</div>
