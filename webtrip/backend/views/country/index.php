<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<?= Html::a( "Create new country",['create'],['class' => 'btn btn-primary']); ?>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Code</th>
        <th>Population</th>
        <th>Capital</th>
    </tr>
    <?php foreach($countries as $country){ ?>
        <tr>
            <td><?= $country->name; ?></td>
            <td><?= $country->cod; ?></td>
            <td><?= $country->population; ?></td>
            <td><?= $country->capital; ?></td>
            <td><?= Html::a("Edit",['edit', 'id_country' => $country->id_country],['class' => 'btn btn-primary']); ?></td>
            <td><?= Html::a( "Delete",['delete', 'id_country' =>$country->id_country],['class' => 'btn btn-danger',
                    'visibleButtons'=>['delete'=>Yii::$app->user->can('superAdmin')]]); ?></td>
        </tr>
    <?php } ?>
</table>
