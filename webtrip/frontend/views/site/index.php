<?php

/* @var $this yii\web\View */

use app\models\Continent;
use app\models\Country;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use conquer\jvectormap\JVectorMapWidget;
use yii\widgets\ActiveForm;

$this->title = 'TripHelper';
?>

<html>


<?//= JVectorMapWidget::widget([
//    'map'=>'world_mill_en',
//]); ?>

<div class ="Country-form">

    <?php $form = ActiveForm::begin(['id' => 'form-country']); ?>
    <?= $form->field($model, 'continent')->dropDownList(ArrayHelper::map(Continent::find()->all(), 'id_continent','name'),
        ['id' =>'cat-id'])?>
<!--    --><?//= $form->field($model, 'country')->widget(DepDrop::className(), [
//            'options'=>['id_country'=>'name','prompt'=>'Select Country'],
//            'pluginOptions'=>[
//                    'depends'=>['cat-id'],
//                    'placeholder'=>['Select Country'],
//                    'url'=>Url::to([Site])
//            ]
//
//
//        ]);

            ?>


    </div>




</html>


