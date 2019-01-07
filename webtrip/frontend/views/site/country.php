<?php

use common\models\Wishlist;
use kartik\rating\StarRating;
use yii\helpers\Html;

$this->title = $country->name;
?>

<h1><?= Html::encode($this->title);?> <?=  Html::img("$country->flag", ['width' => '50px']); ?> </h1>
<br>

<div class="container">
    <div class="row">
        <div class="col-lg-6" >
            <?=  Html::img("$country->country_image",['width' => '500px']); ?>

            <?= Html::a('Plan a trip to this country', ['trip/trip', 'id_country' => $country->id_country],['class' => 'btn btn-primary']) ?>
            <?php if(Wishlist::find()->where(['id_user' => Yii::$app->user->id])->andWhere(['id_country'=>$country->id_country])->one()==null) {?>
            <?= Html::a('Add to wishlist', ['site/add', 'id_country' => $country->id_country],['class' => 'btn btn-primary']) ?>
            <?php } else {?>
            <?= Html::a('Remove from wishlist', ['site/add', 'id_country' => $country->id_country],['class' => 'btn btn-danger  ']) ?>
            <?php } ?>
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

