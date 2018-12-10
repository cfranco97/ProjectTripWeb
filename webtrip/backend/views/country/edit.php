<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\SignupForm */

use common\models\Continent;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-country">
    <h1>Edit this Country</h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-country']); ?>

            <?= $form->field($country, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($country, 'description')->textArea() ?>

            <?= $form->field($country, 'cod') ?>

            <?= $form->field($country, 'population') ?>

            <?= $form->field($country, 'id_continent')->widget(Select2::className(),[
                'data' => ArrayHelper::map(Continent::find()->all(),'id_continent','name'),
                'options' => ['placeholder' => 'Select a continent'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>