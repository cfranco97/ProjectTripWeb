<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<table class="table">
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Country</th>
    </tr>
    <?php foreach($users as $user){ ?>
        <tr>
            <td><?= $user->username; ?></td>
            <td><?= $user->email; ?></td>
            <td><?= $user->country->name; ?></td>
            <td><?= Html::a("Edit",['edit', 'id' => $user->id],['class' => 'btn btn-primary']); ?>
                <?php
                if($user->status==10) { ?>

                    <td><?= Html::a( "Block",['block', 'id' => $user->id],['class' => 'btn btn-danger']); ?></td>
               <?php  } else {?>
                    <td><?= Html::a( "Unblock",['block', 'id' => $user->id],['class' => 'btn btn-danger']); ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
</table>
