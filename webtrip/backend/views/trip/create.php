<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\SignupForm */

use common\models\Continent;
use common\models\Country;
use common\models\User;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-country">
    <h1>Create a Trip</h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-country']); ?>

            <?= $form->field($trip, 'id_country')->widget(Select2::className(),[
                'data' => ArrayHelper::map(Country::find()->all(),'id_country','name'),
                'options' => ['placeholder' => 'Select a country'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($trip, 'id_user')->widget(Select2::className(),[
                'data' => ArrayHelper::map(User::find()->all(),'id','username'),
                'options' => ['placeholder' => 'Select a user'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

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

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>