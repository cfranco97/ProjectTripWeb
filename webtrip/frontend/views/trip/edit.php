<?php

use app\models\Continent;
use app\models\Country;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="site-trip">

    <div class="row">
        <h1>You are planing a trip to <?= $country->name?></h1>
    </div class ="trip-form">

    <?php $form = ActiveForm::begin(['id' => 'trip-form']); ?>
    <?=  $form-> field($trip, 'startdate')->widget(DatePicker::classname(), [

        'options' => ['placeholder' => 'End date & time'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ])
    ?>
    <?=  $form-> field($trip, 'enddate')->widget(DatePicker::classname(), [

        'options' => ['placeholder' => 'End date & time'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ])
    ?>
    <?= $form->field($trip, 'notes')->textArea() ?>
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'trip-button']) ?>
    <?php ActiveForm::end(); ?>


</div>
</div>