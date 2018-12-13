<?php

use common\models\Country;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */

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
    <?= Html::a('Edit password', ['user/change-password','user'=>$user]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>