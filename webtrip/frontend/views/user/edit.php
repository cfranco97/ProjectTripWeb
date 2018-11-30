<?php

use app\models\Continent;
use app\models\Country;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

$items=ArrayHelper::map(Continent::find()->all(), 'id_continent','name');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'id_country')->widget(Select2::className(),[
        'data' => ArrayHelper::map(Country::find()->all(),'id_country','name'),
        'options' => ['placeholder' => 'Country'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($user, 'password_hash')->textInput(['maxlength' => true]) ?>
    <?= Html::a('Edit password', ['site/trips']) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>