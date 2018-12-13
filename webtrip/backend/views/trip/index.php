<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
    <table class="table">
        <tr>
            <th>User</th>
            <th>Country</th>
            <th>Start date</th>
            <th>End date</th>
        </tr>
        <?php foreach($trips as $trip){ ?>
            <tr>
                <td><?= $trip->user->username; ?></td>
                <td><?= $trip->country->name; ?></td>
                <td><?= $trip->startdate; ?></td>
                <td><?= $trip->enddate; ?></td>
                <td><?= Html::a("Edit",['edit', 'id_trip' => $trip->id_trip],['class' => 'btn btn-primary']); ?></td>
                <td><?= Html::a( "Delete",['delete', 'id_trip' =>$trip->id_trip],['class' => 'btn btn-danger']); ?></td>
            </tr>
        <?php } ?>
    </table>
