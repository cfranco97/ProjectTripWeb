<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\SignupForm */

use common\models\Country;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1>Edit this user</h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($user, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($user, 'email') ?>

            <?= $form->field($user, 'id_country')->widget(Select2::className(),[
                'data' => ArrayHelper::map(Country::find()->all(),'id_country','name'),
                'options' => ['placeholder' => 'Select a country'],
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
