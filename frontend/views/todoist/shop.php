<?php

use app\models\Todoist;
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
                'attribute' => 'action',
                'format' => 'raw',
                'contentOptions'=>['class'=>'textTr tr180'],
                'value' => function($model){
                    if ($model->activate == Todoist::COMPLETED){
                        return Html::a(Html::encode('Принять'), ['close', 'id' => $model->id], ['class' => 'accept']).' / '.Html::a(Html::encode('Отклонить'), ['#'], ['class' => 'declinedTodoist', 'value' => Url::to(['declined', 'id' => $model->id])]);
                    } elseif ($model->activate == Todoist::REJECT){
                        return Html::tag('span', Html::encode('Отклонено'), [
                            'class' => 'declined'
                        ]);
                    } else {
                        return false;
                    }

                }
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
                        if ($model->activate == Todoist::ACTIVE){
                            return Html::a('Выполнить', ['accept', 'id' => $model->id], [
                                'data' => [
                                    'confirm' => 'Вы действительно выполнили задачу?',
                                    'method' => 'post',
                                ]
                            ]);
                        } elseif($model->activate == Todoist::COMPLETED) {
                            return Html::encode('На проверке');
                        } else {
                            return Html::tag('span', 'Отклонить', [
                                'title' => $model->declined,
                                'data-toggle' => 'toolpit',
                                'class' => 'declined',
                            ]);
                        }
                    }
                ]
            ],
        ]); ?>
    </div>
</div>
