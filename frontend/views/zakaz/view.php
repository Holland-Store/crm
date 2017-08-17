<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */

$this->title = $model->id_zakaz;
// $this->information = $model->description;
// $this->params['breadcrumbs'][] = ['label' => 'Все закакзы', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
    <div class="zakaz-view">
        <?php Pjax::begin(); ?>

        <div class="col-xs-12">
            <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'detail-view'],
        'attributes' => [
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
                'attribute' => 'prioritetName',
                'label' => 'Приоритет',
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'statusName',
                'label' => 'Этап',
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
                'format' => ['date', 'php:d.m.Y H:i'],
                'visible' => Yii::$app->user->can('seeAdop'),
            ],
            'information',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => $model->img == null ? null : Html::a($model->img, '@web/attachment/'.$model->img, ['download' => true, 'data-pjax' => 0])
            ],
            [
                'attribute' => 'maket',
                'format' => 'raw',
                'value' => $model->maket == null ? null : Html::a($model->maket, '@web/maket/'.$model->maket, ['download' => true, 'data-pjax' => 0]),
                'visible' => $model->maket != null
            ],
            [
                'attribute' => 'statusDisainName',
                'visible' => Yii::$app->user->can('seeDisain') && $model->statusDisain != null,
                'label' => 'Статус у дизайнера',
            ],
            'name',
            'phone',
            [
                'attribute' => 'email',
                'visible' => Yii::$app->user->can('seeDisain'),
            ],
            [
                'attribute' => 'idShipping.dostavkaName',
                'label' => 'Доставка',
            ],
            // 'comment:ntext',
        ],
    ]) ?>
        </div>
        <?php Pjax::end(); ?>
    </div>
