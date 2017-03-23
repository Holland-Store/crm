<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Zakaz;

/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */

$this->title = $model->id_zakaz;
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zakaz-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id_zakaz], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_zakaz], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_zakaz',
            'srok',
            'minut',
            [
                'attribute' => 'idSotrud.name',
                'label' => 'Магазин',

            ],
            'prioritet',
            'status',
            [
                'attribute' => 'idTovar.name',
                'label' => 'Тип товара',
            ],
            'oplata',
            'number',
            'data',
            'description',
            'information',
            'img',
            'name',
            'phone',
            'email',
            'comment:ntext',
        ],
    ]) ?>

</div>
