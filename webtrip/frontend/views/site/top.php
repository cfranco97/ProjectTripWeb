<?php

use yii\grid\GridView;
use yii\helpers\html;
use yii\widgets\DetailView;

?>

<html lang="<?= Yii::$app->language ?>">

<h1>Top</h1>

<div class="container">

    <div class="col-lg-5">
        <h2>Countries</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Position</th>
                <th>Country</th>
                <th>Number of visits</th>
            </tr>
            </thead>
            <tbody>

        <?php
        $x=0; ?><?php
            foreach ($query as $row) { ?>
                <tr>
               <?php $x++; ?>
                    <td><?php echo $x ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->numero ?></td>

        <br>

            <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-lg-2"></div>
    <div class="col-lg-5">
        <h2>Continent</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Position</th>
                <th>Country</th>
                <th>Average rating</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $x=0; ?><?php
            foreach ($query2 as $row) { ?>
            <tr>
                <?php $x++; ?>
                <td><?php echo $x ?></td>
                <td><?php echo $row->name; ?></td>
                <td><?php echo $row->averagerating ?></td>

                <br>

                <?php } ?>
            </tr>
            </tbody>
        </table>
    </div>

</div>