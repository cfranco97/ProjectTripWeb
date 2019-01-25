<?php

use common\models\Continent;
use common\models\Country;
use frontend\assets\AppAsset;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\bootstrap\Html;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

use yii\helpers\Url;
use conquer\jvectormap\JVectorMapWidget;
use yii\widgets\ActiveForm;

$this->title = 'TripHelper';
?>
<div class="container">
<div class="jumbotron">
    <h1>Welcome Bitches</h1>
    <p>YO THERES SOMETHING TO WRITE HERE BUT I DUNNO WAT</p>

</div>

<div class="col-lg-6">
    <h1>Have an account?</h1>
    <small>Login with your credentials</small>
    <div>

        <?php Modal::begin([
            'header' => '<h2>Login</h2>',
            'toggleButton' => ['class'=>'btn btn-primary', 'label'=>'Login'],
        ]);

        $form = ActiveForm::begin(['id' => 'login-form','enableAjaxValidation' => true]); ?>

        <?= $form->field($modelLogin, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($modelLogin, 'password')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <?php Modal::end();
        ?>



    </div>
</div>


<div class="col-lg-6">
    <h1>Don't have an account?</h1>
    <small>Quickly create a new one</small>
    <div>

       <?php Modal::begin([
        'header' => '<h2>Signup</h2>',
        'toggleButton' => ['class'=>'btn btn-primary', 'label'=>'Signup'],
        ]);

        $form = ActiveForm::begin(['id' => 'form-signup','enableAjaxValidation' => true]); ?>

        <?= $form->field($modelRegister, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($modelRegister, 'email') ?>

        <?= $form->field($modelRegister, 'password')->passwordInput() ?>

        <?= $form->field($modelRegister, 'id_country')->widget(Select2::className(),[
            'data' => ArrayHelper::map(Country::find()->all(),'id_country','name'),
            'options' => ['placeholder' => 'Select a country'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <div class="form-group">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Modal::end() ?>



</div>
</div>
</div>