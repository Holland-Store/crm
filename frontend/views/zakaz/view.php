<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Zakaz;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */

$this->title = $model->id_zakaz;
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zakaz-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php var_dump($model->status); ?>
        <?php $form = ActiveForm::begin(); ?>
        <?= Html::a('Выполнить', ['view', 'id' => $model->id_zakaz], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => 'Вы уверены, что хотите одобрить',
                'method' => 'post',
            ]
        ]) ?>
       <?php ActiveForm::end(); ?>

        <?php if (Yii::$app->user->can('disain')): ?>
        <?= Html::button('Выполнено', ['class' => 'btn btn-primary']) ?>
        <?php endif ?>  

        <?php if (Yii::$app->user->can('admin')): ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id_zakaz], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
        
        <?php if (Yii::$app->user->can('admin')){ ?>           
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_zakaz], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_zakaz',
            [
                'attribute' => 'srok',
                'visible' => Yii::$app->user->can('seeIspol'),
            ],
            [
                'attribute' => 'minut',
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'idSotrud.name',
                'label' => 'Магазин',
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'prioritet',
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'status',
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'idTovar.name',
                'label' => 'Тип товара',
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'oplata',
                'visible' => Yii::$app->user->can('seeAdop'),
            ],
            'number',
            [
                'attribute' => 'data',
                'visible' => Yii::$app->user->can('seeAdop'),
            ],
            'description',
            'information',
            'img',
            'name',
            'phone',
            [
                'attribute' => 'email',
                'visible' => Yii::$app->user->can('admin'),
            ],
            'comment:ntext',
        ],
    ]) ?>

</div>
