<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
    <table class="table">
        <tr>
            <th>User</th>
            <th>Rating</th>
            <th>Country</th>
            <th>Message</th>
        </tr>
        <?php foreach($reviews as $review){ ?>
            <tr>
                <td><?= $review->user->username; ?></td>
                <td><?= $review->rating; ?></td>
                <td><?= $review->trip->country->name; ?></td>
                <td><?= $review->message; ?></td>
                <td><?= Html::a("Edit",['edit', 'id_review' => $review->id_review],['class' => 'btn btn-primary']); ?></td>
                <td><?= Html::a( "Delete",['delete', 'id_review' =>$review->id_review],['class' => 'btn btn-danger']); ?></td>
            </tr>
        <?php } ?>
    </table>