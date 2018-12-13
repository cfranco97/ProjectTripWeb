<?php

/* @var $this yii\web\View */

use common\models\User;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<!--<table class="table">-->
<!--    <tr>-->
<!--        <th>Username</th>-->
<!--        <th>Email</th>-->
<!--        <th>Country</th>-->
<!--    </tr>-->
<!--    --><?php //foreach($users as $user){ ?>
<!--        <tr>-->
<!--            <td>--><?//= $user->username; ?><!--</td>-->
<!--            <td>--><?//= $user->email; ?><!--</td>-->
<!--            <td>--><?//= $user->country->name; ?><!--</td>-->
<!--            <td>--><?//= Html::a("Edit",['edit', 'id' => $user->id],['class' => 'btn btn-primary']); ?>
<!--                --><?php
//                if($user->status==10) { ?>
<!---->
<!--                    <td>--><?//= Html::a( "Block",['block', 'id' => $user->id],['class' => 'btn btn-danger']); ?><!--</td>-->
<!--               --><?php // } else {?>
<!--                    <td>--><?//= Html::a( "Unblock",['block', 'id' => $user->id],['class' => 'btn btn-danger']); ?><!--</td>-->
<!--            --><?php //} ?>
<!--        </tr>-->
<!--    --><?php //} ?>
<!--</table>-->
   <?php $gridColumns = [
    [
        'attribute' => 'username',
        'vAlign' => 'middle',
        'width' => '180px',
    ],
    [
        'attribute' => 'email',
        'vAlign' => 'middle',
        'width' => '180px',
    ],

] ?>
<?php echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => $gridColumns, // check the configuration for grid columns by clicking button above
    'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
    'headerRowOptions' => ['class' => 'kartik-sheet-style'],
    'filterRowOptions' => ['class' => 'kartik-sheet-style'],
    'pjax' => true,

    ]); // pjax is set to always true for this demo?>