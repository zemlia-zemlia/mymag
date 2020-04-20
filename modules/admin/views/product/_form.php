<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
$propertyValues = \yii\helpers\ArrayHelper::map($model->propertyValues, 'id_property', 'value');
//\yii\helpers\VarDumper::dump($propertyValues[2] , 5,true);die;
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'article')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'decsription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_id')->textInput() ?>


    
    <?php foreach ($model->category[0]->properties as $property) : ?>
    
    <p><label ><?= $property->name ?></label><input type="text" name="propertyValues[<?= $property->id ?>]" value="<?= $propertyValues[$property->id] ?>"></p>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
