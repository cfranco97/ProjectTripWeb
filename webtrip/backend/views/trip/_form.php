<?php

use common\models\Country;
use common\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Trip */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_country')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Country::find()->all(),'id_country','name'),
        'options' => ['placeholder' => 'Select a Country'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_user')->widget(Select2::className(),[
        'data' => ArrayHelper::map(User::find()->all(),'id','username'),
        'options' => ['placeholder' => 'Select a User'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?=  $form-> field($model, 'startdate')->widget(DatePicker::classname(), [

        'options' => ['placeholder' => 'End date & time'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ])
    ?>
    <?=  $form-> field($model, 'enddate')->widget(DatePicker::classname(), [

        'options' => ['placeholder' => 'End date & time'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
        ]
    ])
    ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
