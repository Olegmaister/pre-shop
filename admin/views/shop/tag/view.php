<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $tag \shop\Entities\Shop\Products\Tag */

$this->title = $tag->name;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $tag->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $tag->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $tag,
                'attributes' => [
                    'id',
                    'name',
                    'slug',
                ],
            ]) ?>
        </div>
    </div>
</div>
