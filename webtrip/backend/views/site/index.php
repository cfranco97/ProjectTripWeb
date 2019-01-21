<?php

/* @var $this yii\web\View */

use backend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <img class="img" src="http://localhost/ProjectTripWeb/webtrip/backend/web/images/users.svg" alt="Card image cap">

                    <p class="card-text">Search for users, update their information and block or unblock them from your website.</p>
                    <?= Html::a('Manage Users', ['user/index'], ['class' => 'btn btn-primary']) ?>

            </div>
        </div>

        <div class="col-lg-3">
            <div class="card">
                <img class="img" src="http://localhost/ProjectTripWeb/webtrip/backend/web/images/worldwide.svg" alt="Card image cap">

                    <p class="card-text">Create new countries, edit or delete them.</p>
                    <?= Html::a('Manage Countries', ['country/index'], ['class' => 'btn btn-primary']) ?>

            </div>

        </div>
        <div class="col-lg-3">
            <div class="card">
                <img class="img" src="http://localhost/ProjectTripWeb/webtrip/backend/web/images/survey.svg" alt="Card image cap">

                    <p class="card-text">Search for reviews with the abillity to remove unwanted ones.</p>
                    <?= Html::a('Manage Reviews', ['review/index'], ['class' => 'btn btn-primary']) ?>

            </div>

        </div>


        <div class="col-lg-3">
            <div class="card">
                <img class="img" src="http://localhost/ProjectTripWeb/webtrip/backend/web/images/world-location.svg" alt="Card image cap">

                    <p class="card-text">Search all trips, edit and remove them.</p>
                    <?= Html::a('Manage Trips', ['trip/index'], ['class' => 'btn btn-primary']) ?>

            </div>

        </div>
</div>
</div>
