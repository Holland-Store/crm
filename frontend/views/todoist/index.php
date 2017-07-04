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
/* @var $searchModel app\models\TodoistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Все задачи';
?>
<div class="todoist-index">

    <p>
        <?php if (Yii::$app->user->can('admin')): ?>
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
                            'url' => ['custom/create']
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
                            'url' => ['todoist/create']
                        ],
                    ]
                ]
            ]); ?>
=======
$this->title = 'Задачник';
?>
<div class="todoist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if (Yii::$app->user->can('admin')): ?>
            <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        <?php endif ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
<<<<<<< HEAD
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
=======
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'srok',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'attribute' => 'activate',
                'value' => function($model){
                    return $model->todoistName;
                }
            ],
            [
				'attribute' => 'id_user',
				'value' => function($model){
					return $model->idUser->name;
				}
			],
            'comment:ntext',
            [
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
                'attribute' => 'zakaz',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->id_zakaz != null) {
                        return Html::a($model->idZakaz->prefics, ['zakaz/view', 'id' => $model->id_zakaz]);
                    } 
                    return '';
                },
                'label' => 'Заказ',
<<<<<<< HEAD
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr50'],
            ],
            [
                'attribute' => 'id_user',
                'value' => function($model){
                    return $model->idUser->name;
                },
                'contentOptions' => ['class' => 'border-right textTr'],
            ],
        ],
    ]); ?>
</div>
<div class="footer-todoist">
    <?php echo Nav::widget([
        'options' => ['class' => 'nav nav-pills footerNav'],
        'items' => [
            ['label' => 'Архив', 'url' => ['closetodoist'], 'visible' => Yii::$app->user->can('seeAdmin')],
=======
            ],


//            ['class' => 'yii\grid\ActionColumn'],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?>
</div>
