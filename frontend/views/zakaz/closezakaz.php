<?php

use yii\helpers\Html;
<<<<<<< HEAD
use kartik\grid\GridView;
use app\models\Zakaz;
use yii\helpers\StringHelper;
=======
use yii\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\grid\SetColumn;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Закрытые заказы';
?>
 
<div class="zakaz-index">
<<<<<<< HEAD

    <div class="col-xs-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'floatHeader' => true,
            'headerRowOptions' => ['class' => 'headerTable'],
            'pjax' => true,
            'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
            'rowOptions' => function($model, $key, $index, $grid){
                if ($model->srok < date('Y-m-d') && $model->status > Zakaz::STATUS_NEW ) {
                    return ['class' => 'trTable trTablePass italic trSrok'];
                } elseif ($model->srok < date('Y-m-d') && $model->status == Zakaz::STATUS_NEW) {
                    return['class' => 'trTable trTablePass bold trSrok trNew'];
                } elseif ($model->srok > date('Y-m-d') && $model->status == Zakaz::STATUS_NEW){
                    return['class' => 'trTable bold trSrok trNew'];
                } else {
                    return ['class' => 'trTable trNormal'];
                }
            },
            'striped' => false,
            'columns' => [
                [
                    'class'=>'kartik\grid\ExpandRowColumn',
                    'contentOptions' => function($model, $index, $grid){
                        return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
                    },
                    'width'=>'10px',
                    'value' => function ($model, $key, $index) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('_zakaz', ['model'=> $model]);
                    },
                    'enableRowClick' => true,
                    'expandOneOnly' => true,
                    'expandIcon' => ' ',
                    'collapseIcon' => ' ',
                ],
                [
                    'attribute' => 'id_zakaz',
                    'value' => 'prefics',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr50'],
                ],
                [
                    'attribute' => '',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'tr20'],
                    'value' => function($model){
                        if ($model->prioritet == 2) {
                            return '<i class="fa fa-circle fa-red" aria-hidden="true"></i>';
                        } elseif ($model->prioritet == 1) {
                            return '<i class="fa fa-circle fa-ping" aria-hidden="true"></i>';
                        } else {
                            return '';
                        }

                    }
                ],
                [
                    'attribute' => 'srok',
                    'format' => ['datetime', 'php:d M H:i'],
                    'value' => 'srok',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr90'],
                ],
                [
                    'attribute' => 'minut',
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr10'],
                ],
                [
                    'attribute' => 'description',
                    'value' => function($model){
                        return StringHelper::truncate($model->description, 100);
                    }
                ],
                [
                    'attribute' => 'id_shipping',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'tr50'],
                    'value' => function($model){
                        if ($model->idShipping->status == 0 or $model->idShipping->status == 1) {
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #f0ad4e;" aria-hidden="true"></i>';
                        } elseif ($model->idShipping->status == 2){
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #191412;" aria-hidden="true"></i>';
                        } else{return '';}
                    }
                ],
                [
                    'attribute' => 'oplata',
                    'value' => function($model){
                        return $model->oplata.' р.';
                    },
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr50'],
                ],
                [
                    'attribute' => '',
                    'format' => 'raw',
                    'value' => function($model){
                        return '';
                    },
                    'contentOptions' => ['class' => 'textTr tr20'],
                ],
                [
                    'format' => 'raw',
                    'value' => function($model){
                        return Html::a('Восстановить', ['restore', 'id' => $model->id_zakaz], [
                            'data' => [
                                'confirm' => 'Вы действительно хотите восстановить заказ?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'contentOptions' => ['class' => 'textTr border-right tr90'],
                ],

            ],
        ]); ?>
=======
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-xs-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20']
            ],
            [
            'attribute' => 'description',
            'headerOptions' => ['width' => '550'],
            ],
             [
                'attribute' => 'id_tovar',
                'value' => 'idTovar.name',
                'filter' => Zakaz::getTovarList(),
                'headerOptions' => ['width' => '100'],
            ],
             [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d.m.Y'],
                'value' => 'srok',
                'filter' => DatePicker::widget([
                     'model' => $searchModel,
                     'attribute' => 'srok',
                     'inline' => false, 
                    'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy.mm.dd'
                ],
                ]),
                'headerOptions' => ['width' => '70'],
            ],
            [
                'attribute' => 'minut',
                'format' => ['time', 'php:H:i'],
                'headerOptions' => ['width' => '10'],
            ],
            [
                'attribute' => 'fact_oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'img',
                'format' => 'raw',
                
            ],
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a(
                    '<button class = "btn btn-primary">Открыть</button>', 
                    $url);
                },
            ],
            ],
        ],
    ]); ?>  
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
    </div>
</div>
