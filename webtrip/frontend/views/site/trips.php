<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>
<?php foreach ($trips as $trip) {?>

        <header>
            <h4><?= $trip->id_country ?></h4>
        </header>
    <h4><?= $trip->startdate ?></h4>
    <h4><?= $trip->enddate ?></h4>

<?php } ?>
