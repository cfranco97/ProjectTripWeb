<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-3">
                <?= Html::a('Manage Users', ['user/index'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::a('Manage Countries', ['country/index'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::a('Manage Trips', ['trip/index'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::a('Manage Review', ['review/index'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    </div>
</div>
