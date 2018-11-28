<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


$this->title = $country->name;
?>

<h1><?= Html::encode($this->title) ?></h1>
<table>
    <tr>
    <th>Capital: <?= $country->capital?></th>
    </tr>
    <tr>
    <th>Population: <?= $country->population?></th>
    </tr>
    <tr>
    <th><?= $country->description?></th>
    </tr>
</table>

<?= Html::a('Plan a trip to this country', ['site/trips']) ?>

