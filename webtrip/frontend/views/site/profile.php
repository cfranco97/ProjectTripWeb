<?php

use yii\helpers\html;
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

            <p>Name:</p>
            <p>Username:</p>
            <p>Email:</p>
            <p>Country:</p>
            <br>
            <?= Html::a('Edit Profile', ['/site/edit-profile'], ['class'=>'btn btn-primary']) ?>

        </div>

        <div class="col-lg-5" >

            <h3>X% World Visited</h3>
            <h3>X Countries Visited</h3>
            <br>
            <?= Html::a('Gallery', ['/site/gallery'], ['class'=>'btn btn-primary']) ?>
            <br>
            <br>
            <?= Html::a('New Trip', ['/site/trips'], ['class'=>'btn btn-primary']) ?>

        </div>

    </div>

</div>




</body>
</html>