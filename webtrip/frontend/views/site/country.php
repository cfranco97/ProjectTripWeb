<?php

use kartik\icons\Icon;
use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$this->title = $country->name;
?>

<h1><?= Html::encode($this->title);?> <?=  Html::img("$country->flag", ['width' => '50px']); ?> </h1>
<br>

<div class="container">
    <div class="row">
        <div class="col-lg-6" >
            <?=  Html::img("$country->country_image",['width' => '500px']); ?>

            <?= Html::a('Plan a trip to this country', ['trip/trip', 'id_country' => $country->id_country],['class' => 'btn btn-primary']) ?>
            <?php Pjax::begin(); ?>
            <?= Html::beginForm(['site/add'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
            <?= Html::submitButton('Add to your wishlist', ['class' => 'btn btn-primary', 'name' => 'hash-button']) ?>
            <?= Html::endForm() ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="col-lg-4">
<table>
    <tr>
    <th>Capital: <?= $country->capital?></th>
    </tr>
    <tr>
    <th>Population: <?= $country->population?></th>
    </tr>
    <tr>
    <th>Description: <?= $country->description?></th>
    </tr>
</table>
        </div>
    </div>
</div>
<br>
<div class="conainter"
    <div class="row">
    <?php
        foreach ($reviews as $review) { ?>
        <div class="col-lg-4" >
            <small><?= $review->user->username?> review</small>
            <?php echo StarRating::widget([
                'name' => 'rating_21',
                'value' => $review->rating,
                'pluginOptions' => [
                    'readonly' => true,
                    'showClear' => false,
                    'showCaption' => false,
                ],
            ]);
            ?>
        <br>
            <?php echo $review->message ?>
        </div>
            <?php } ?>

    </div>
</div>

