<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\Helpers\ArrayHelper;
use common\models\User;
use kartik\select2\Select2;
use conquer\jvectormap\JVectorMapWidget;

$this->title = 'TripHelper';
?>

<html>


<?= JVectorMapWidget::widget([
    'map'=>'world_mill_en',
]); ?>

<!--<div class="comment-form">-->
<!---->
<!--    --><?php //$form = ActiveForm::begin(); ?>
<!---->
<!--    --><?//= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'status')->textInput() ?>
<!---->
<!---->
<!--    --><?//= $form->field($model, 'id_country')->widget(Select2::className(),[
//        'data' => ArrayHelper::map(Post::find()->all(),'id','title'),
//        'options' => ['placeholder' => 'Select a post'],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]); ?>
<!---->
<!--    <div class="form-group">-->
<!--        --><?//= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
<!--    </div>-->
<!---->
<!--    --><?php //ActiveForm::end(); ?>
<!---->
<!--</div>-->



</html>


