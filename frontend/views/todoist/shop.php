<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodoistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $dataProviderTheir yii\data\ActiveDataProvider */
/* @var $dataProviderAlien yii\data\ActiveDataProvider */

$this->title = 'Все задачи';
?>
<div class="todoist-index">
    <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    <div class="col-lg-12">
        <h3><?= Html::encode('Свои') ?></h3>
    </div>
    <div class="col-lg-12">
    <?= GridView::widget([
        'dataProvider' => $dataProviderTheir,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
        'rowOptions' => ['class' => 'trTable trNormal'],
        'striped' => false,
        'columns' => [
            [
                'attribute' => 'srok',
                'format' => ['date', 'php:d M'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-left textTr tr90', 'style' => 'border:none'],
            ],
            [
                'attribute' => 'comment',
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            [
                'attribute' => 'zakaz',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->id_zakaz != null) {
                        return Html::a($model->idZakaz->prefics, ['zakaz/view', 'id' => $model->id_zakaz]);
                    }
                    return '';
                },
                'label' => 'Заказ',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr70'],
            ],
            [
                'attribute' => 'id_user',
                'value' => function($model){
                    return $model->idSotrudPut->name;
                },
                'contentOptions' => ['class' => 'textTr tr50'],
            ],
        ],
    ]); ?>
    </div>
    <div class="col-lg-12">
        <h3><?= Html::encode('Поступило') ?></h3>
    </div>
    <div class="col-lg-12">
        <?= GridView::widget([
            'dataProvider' => $dataProviderAlien,
            'floatHeader' => true,
            'headerRowOptions' => ['class' => 'headerTable'],
            'pjax' => true,
            'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
            'rowOptions' => ['class' => 'trTable trNormal'],
            'striped' => false,
            'columns' => [
                [
                    'attribute' => 'srok',
                    'format' => ['date', 'php:d M'],
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'border-left textTr tr90', 'style' => 'border:none'],
                ],
                [
                    'attribute' => 'comment',
                    'contentOptions'=>['style'=>'white-space: normal;'],
                ],
                [
                    'attribute' => 'zakaz',
                    'format' => 'raw',
                    'value' => function($model){
                        if ($model->id_zakaz != null) {
                            return Html::a($model->idZakaz->prefics, ['zakaz/view', 'id' => $model->id_zakaz]);
                        }
                        return '';
                    },
                    'label' => 'Заказ',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr70'],
                ],
                [
                    'attribute' => 'id_sotrud_put',
                    'value' => function($model){
                        return $model->idSotrudPut->name;
                    },
                    'contentOptions' => ['class' => 'textTr tr50'],
                ],
                [
                    'attribute' => '',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'border-right textTr tr50 ispolShop'],
                    'value' => function($model){
                        return Html::a('Выполнить', ['close', 'id' => $model->id], [
                            'data' => [
                                'confirm' => 'Вы действительно выполнили задачу?',
                                'method' => 'post',
                            ]
                        ]);
                    }
                ]
            ],
        ]); ?>
    </div>
</div>
