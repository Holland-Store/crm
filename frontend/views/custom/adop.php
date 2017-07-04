<?php

<<<<<<< HEAD
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;
use kartik\grid\GridView;
=======
use yii\helpers\Html;
use yii\grid\GridView;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Все запросы';?>
<div class="custom-index">

    <p>
        <?php echo ButtonDropdown::widget([
            'label' => '+',
            'options' => [
                'class' => 'btn buttonAdd',
            ],
            'dropdown' => [
                'items' => [
                    [
                        'label' => 'Заказ',
                        'url' => ['zakaz/create'],
                        'visible' => Yii::$app->user->can('seeAdop')
                    ],
                    [
                        'label' => '',
                        'options' => [
                            'role' => 'presentation',
                            'class' => 'divider'
                        ]
                    ],
                    [
                        'label' => 'Закупки',
                        'url' => 'create'
                    ],
                    [
                        'label' => '',
                        'options' => [
                            'role' => 'presentation',
                            'class' => 'divider'
                        ]
                    ],
                    [
                        'label' => 'Поломки',
                        'url' => ['helpdesk/create']
                    ],
                    [
                        'label' => '',
                        'options' => [
                            'role' => 'presentation',
                            'class' => 'divider'
                        ]
                    ],
                    [
                        'label' => 'Задачи',
                        'url' => ['todoist/create'],
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                ]
            ]
        ]); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
        'striped' => false,
        'rowOptions' => ['class' => 'trTable srok trNormal'],
        'columns' => [
            [
				'attribute' => 'date',
				'format' => ['datetime', 'php:d M H:m'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-left textTr tr90', 'style' => 'border:none'],
			],
            [
                'attribute' => 'tovar',
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            [
                'attribute' => 'number',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr50'],
            ],
            [
                'attribute' => 'action',
                'value' => function($model){
                    return $model->action == 0 ? 'В процессе' : 'Привезен';
                },
                'contentOptions' => ['class' => 'border-right textTr tr90'],
            ],
//            [
//                'header' => 'Действие',
//                'format' => 'raw',
//                'value' => function($model){
//                    return $model->action == 0 ? Html::a('Привезен', ['brought', 'id' => $model->id]) : '';
//                }
//            ],
=======
$this->title = 'Запросы';?>
<div class="custom-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
				'attribute' => 'date',
				'format' => ['datetime', 'dd.MM.Y H:m'],
			],
            'id_user',
            'tovar',
            'number',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?>
</div>
