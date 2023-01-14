<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use shop\Entities\Shop\Characteristic;
/* @var $this yii\web\View */
/* @var $model \shop\Forms\Shop\Products\CharacteristicCreateForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'type')->dropDownList(Characteristic::isVariants()) ?>
            <?=$form->field($model, 'required')->checkbox()?>
            <?= $form->field($model, 'textVariants')->textarea() ?>
            <?= $form->field($model, 'default')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
