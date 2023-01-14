<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \shop\Forms\Shop\Products\ProductCreateForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]); ?>

    <div class="box box-default">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model->photos, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
            <?= $form->field($model, 'brandId')->dropDownList($model->getBrands()) ?>
            <?= $form->field($model->categories, 'main')->dropDownList($model->getCategories()) ?>
            <?= $form->field($model->categories, 'others')->checkboxList(
                $model->getCategories(),
                ['separator' => '<br>']
            )->label('Дополнительные категории')
            ?>
            <?= $form->field($model->tags, 'existing')->checkboxList(
                $model->getTags(),
                ['separator' => '<br>']
            )->label('Укажите метки')
            ?>
            <?= $form->field($model->price, 'new')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model->price, 'old')->textInput(['maxlength' => true]) ?>

            <div class="box box-default">
                <div class="box-header with-border">Characteristics</div>
                <div class="box-body">
                    <?php foreach ($model->characteristicValue as $i => $characteristicValue):
                        ?>
                        <?php if ($variants = $characteristicValue->variantsList()): ?>
                            <?= $form->field($characteristicValue, '[' . $i . ']characteristicValue',[])->dropDownList($variants, ['prompt' => $characteristicValue->getDefaultValue()]) ?>
                        <?php else: ?>
                            <?= $form->field($characteristicValue, '[' . $i . ']characteristicValue',['value' => $characteristicValue->getDefaultValue()])->textInput() ?>
                        <?php endif ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="box box-default">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= $form->field($model->meta, 'title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model->meta, 'description')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model->meta, 'keywords')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
