<?php

/* @var $this yii\web\View */
/* @var $brand \shop\Entities\Shop\Brand */
/* @var $model \shop\Forms\Shop\BrandEditForm */

$this->title = 'Update Brand: ' . $brand->name;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $brand->name, 'url' => ['view', 'id' => $brand->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
