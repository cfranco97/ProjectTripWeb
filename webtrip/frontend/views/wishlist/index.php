<?php

use common\models\Country;
use yii\helpers\html;

?>

<html lang="<?= Yii::$app->language ?>">

<h1><b>Wishlist</b></h1>
<div class="col-lg-12">
    <table class="table">
        <thead>
        <tr>
            <th>Country</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($wishlist as $row) { ?>
        <?php
        foreach ($row->countries as $country) { ?>
        <tr>
            <td><?=  Html::img("$country->flag", ['width' => '50px']) ." "?><?php echo $country->name ?></td>
            <td><?= Html::a('View information', ['review/index'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['review/index'], ['class' => 'btn btn-danger']) ?></td>
            <?php $query=Country::findBySql('SELECT country.name,COUNT(review.id_trip) AS numero FROM review LEFT JOIN country ON review.id_country = country.id_country WHERE country.name="'.$country->name.'"')->all();
            ?>
            <td><?php echo count($country->trips)?></td>

            <?php } ?>


        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>