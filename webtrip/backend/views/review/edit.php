<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\SignupForm */

use common\models\Continent;
use kartik\rating\StarRating;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = 'Create';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="site-country">
        <h1>Edit this Review</h1>

        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'rating-form']); ?>
                <?= $form->field($review, 'rating')->widget(StarRating::classname(), [
                    'pluginOptions' => ['step' => 0,5]
                ]);
                ?>
                <?= $form->field($review, 'message')->textArea() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
