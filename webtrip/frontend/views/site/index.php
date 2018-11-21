<?php

/* @var $this yii\web\View */

use conquer\jvectormap\JVectorMapWidget;

$this->title = 'TripAdvisor';
?>

<html>


<?= JVectorMapWidget::widget([
    'map'=>'world_mill_en',
]); ?>


</html>


