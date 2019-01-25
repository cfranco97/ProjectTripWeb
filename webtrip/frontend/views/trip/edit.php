<?php

use dosamigos\ckeditor\CKEditor;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
    <?= $form->field($trip, 'notes')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,'removeButtons'=> 'ImageButton'],
        'preset' => 'basic',

        'clientOptions' => [
            'buttonsHide' => ['image','file']],
    ]) ?>
    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'trip-button']) ?>
    <?php ActiveForm::end(); ?>


</div>
</div>