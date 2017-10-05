<?php

use app\models\Courier;
use app\models\Zakaz;
use kartik\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?php $this->title = 'Все заказы' ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'floatHeader' => true,
    'headerRowOptions' => ['class' => 'headerTable'],
    'pjax' => true,
    'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
    'rowOptions' => ['class' => 'trTable trNormal'],
    'striped' => false,
    'columns' => [
        [
            'class'=>'kartik\grid\ExpandRowColumn',
            'contentOptions' => function($model){
                return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
            },
            'width'=>'10px',
            'value' => function () {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model) {
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
            'contentOptions' => function($model) {
                if ($model->status == Zakaz::STATUS_NEW){
                    return ['class' => 'trNew tr70 '];
                } else {
                    return ['class' => 'textTr tr70'];
                }
            },
        ],
        [
            'attribute' => '',
            'format' => 'raw',
            'contentOptions' => ['class' => 'tr20'],
            'value' => function($model){
                if ($model->prioritet == 2) {
                    return '<i class="fa fa-circle fa-red"></i>';
                } elseif ($model->prioritet == 1) {
                    return '<i class="fa fa-circle fa-ping"></i>';
                } else {
                    return '';
                }

            }
        ],
        [
            'attribute' => 'srok',
            'format' => ['datetime', 'php:d M H:i'],
            'hAlign' => GridView::ALIGN_RIGHT,
            'contentOptions' => function($model) {
                if ($model->status == Zakaz::STATUS_NEW){
                    return ['class' => 'trNew tr100 srok'];
                } else {
                    return ['class' => 'textTr tr100 srok'];
                }
            },
        ],
        [
            'attribute' => 'description',
            'value' => function($model){
                return StringHelper::truncate($model->description, 100);
            }
        ],
        [
            'attribute' => 'tag',
            'format' => 'raw',
            'contentOptions' => ['class' => 'tr90'],
            'value' => function($model){
                return $model->tags != null ? $model->getTagsAsString('gridview') : false;
            }
        ],
        [
            'attribute' => 'id_shipping',
            'format' => 'raw',
            'contentOptions' => ['class' => 'tr50'],
            'value' => function($model){
                if ($model->id_shipping == null or $model->id_shipping == null){
                    return '';
                } else {
                    if ($model->idShipping->status == Courier::DOSTAVKA or $model->idShipping->status == Courier::RECEIVE) {
                        return '<i class="fa fa-truck" style="font-size: 13px;color: #f0ad4e;"></i>';
                    } elseif ($model->idShipping->status == Courier::DELIVERED){
                        return '<i class="fa fa-truck" style="font-size: 13px;color: #191412;"></i>';
                    } else {
                        return '';
                    }
                }
            }
        ],
        [
            'attribute' => 'oplata',
            'value' => 'money',
            'hAlign' => GridView::ALIGN_RIGHT,
            'contentOptions' => function($model) {
                if ($model->status == Zakaz::STATUS_NEW){
                    return ['class' => 'trNew tr70'];
                } else {
                    return ['class' => 'textTr tr70'];
                }
            },
        ],
        [
            'attribute' => '',
            'format' => 'raw',
            'value' => function(){
                return '';
            },
            'contentOptions' => ['class' => 'textTr border-right tr90'],
        ]
//            [
//                'attribute' => 'status',
//                'class' => SetColumn::className(),
//                'label' => 'Отв-ный',
//                'format' => 'raw',
//                'name' => 'statusName',
//                'cssCLasses' => [
//                    Zakaz::STATUS_NEW => 'primary',
//                    Zakaz::STATUS_EXECUTE => 'success',
//                    Zakaz::STATUS_ADOPTED => 'warning',
//                    Zakaz::STATUS_REJECT => 'danger',
//                    Zakaz::STATUS_SUC_DISAIN => 'success',
//                    Zakaz::STATUS_SUC_MASTER => 'success',
//                ],
//                'contentOptions' => ['class' => 'border-right'],
//            ],
    ],
]); ?>
