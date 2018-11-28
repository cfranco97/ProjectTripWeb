<?php

/* @var $this yii\web\View */

use app\models\Continent;
use kartik\depdrop\DepDrop;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;

use yii\helpers\Url;
use conquer\jvectormap\JVectorMapWidget;
use yii\widgets\ActiveForm;

$this->title = 'TripHelper';
?>

<html>

<div>
<?= JVectorMapWidget::widget([
    'map'=>'world_mill_en',
]); ?>
</div>

<h1>BAD AT GEOGRAPHY?</h1>
    <div>

    <?php $form = ActiveForm::begin(['id' => 'country-form']); ?>
    <?= $form->field($model, 'continent')->dropDownList(ArrayHelper::map(Continent::find()->all(), 'id_continent','name'),
        ['id' =>'cat-id', 'prompt'=>'Select a Continent'])?>
    <?= $form->field($model, 'country')->widget(DepDrop::className(), [
            'options'=>['id_country'=>'name','prompt'=>'Select Continent first'],
            'type' => DepDrop::TYPE_SELECT2,
            'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder'=>['Select Country'],
                    'url'=>Url::to(['site/subcat'])
            ]


        ]);
    ?>
        <div class="form-group">
            <?= Html::submitButton('View', ['class' => 'btn btn-primary', 'name' => 'country-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>


    </div>

</html>


