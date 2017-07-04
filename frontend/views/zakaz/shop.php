<?php

<<<<<<< HEAD
use yii\bootstrap\Nav;
use yii\helpers\StringHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Zakaz;
use yii\bootstrap\ButtonDropdown;
=======
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
// use yii\grid\SetColumn;
use yii\widgets\Pjax;

>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'ВСЕ ЗАКАЗЫ';
?>
<?php Pjax::begin(); ?>

<div class="zakaz-shop">

    <?php echo ButtonDropdown::widget([
        'label' => '+',
        'options' => [
            'class' => 'btn buttonAdd',
        ],
        'dropdown' => [
            'items' => [
                [
                    'label' => 'Заказ',
                    'url' => 'zakaz/create',
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
                    'url' => 'custom/create'
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
                    'url' => 'helpdesk/create'
                ],
                [
                    'label' => '',
                    'options' => [
                        'role' => 'presentation',
                        'class' => 'divider'
                    ]
                ],
            ]
        ]
    ]); ?>
    <div class="col-lg-3 zakazSearch">
        <?php echo $this->render('_search', ['model' => $searchModel]);?>
    </div>
    <div class="col-lg-9 shopZakaz">
        <h3 class="titleTable">Исполнено</h3>
    </div>
    <div class="col-xs-12 ispolShop">
        <?= GridView::widget([
            'dataProvider' => $dataProviderExecute,
            'floatHeader' => true,
            'headerRowOptions' => ['class' => 'headerTable'],
            'pjax' => true,
            'striped' => false,
            'tableOptions' => ['class' => 'table table-bordered tableSize'],
            'rowOptions' => ['class' => 'trTable srok trNormal'],
            'columns' => [
                [
                    'class'=>'kartik\grid\ExpandRowColumn',
                    'contentOptions' => function($model, $key, $index, $grid){
                        return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
                    },
                    'width'=>'10px',
                    'value' => function ($model, $key, $index) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('_zakaz', ['model'=>$model]);
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
                    'contentOptions' => ['class' => 'textTr tr70'],
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
                    'value' => function($model){
                        if ($model->minut == null){
                            return '';
                        } else {
                            return $model->minut;
                        }
                    }
                ],
                [
                    'attribute' => 'description',
                    'value' => function($model){
                        return StringHelper::truncate($model->description, 100);
                    }
                ],
                [
                    'attribute' => 'oplata',
                    'value' => function($model){
                        return $model->oplata.' р.';
                    },
                    'hAlign' => GridView::ALIGN_RIGHT,
                    'contentOptions' => ['class' => 'textTr tr70'],
                ],
                [
                    'attribute' => '',
                    'format' => 'raw',
                    'value' => function($model){
                        if ($model->status == Zakaz::STATUS_EXECUTE){
                            return Html::a('Готово', ['close']);
                        } else {
                            return '';
                        }
                    },
                    'contentOptions' => ['class' => 'textTr border-right tr70'],
                ]
            ],
        ]); ?>
    </div>
    <div class="col-lg-12">
        <h3 class="titleTable">В работе</h3>
    </div>
    <div class="col-xs-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'striped' => false,
        'tableOptions' => ['class' => 'table table-bordered tableSize'],
        'rowOptions' => ['class' => 'trTable srok trNormal'],
        'columns' => [
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'contentOptions' => function($model, $key, $index, $grid){
                    return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
                },
                'width'=>'10px',
                'value' => function ($model, $key, $index) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    return Yii::$app->controller->renderPartial('_zakaz', ['model'=>$model]);
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
                'contentOptions' => ['class' => 'textTr tr70'],
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
                'value' => function($model){
                    if ($model->minut == null){
                        return '';
                    } else {
                        return $model->minut;
                    }
                }
            ],
            [
                'attribute' => 'description',
                'value' => function($model){
                    return StringHelper::truncate($model->description, 100);
                }
            ],
            [
                'attribute' => 'oplata',
                'value' => function($model){
                    return $model->oplata.' р.';
                },
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr70'],
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function($model){
                   if ($model->status == Zakaz::STATUS_EXECUTE){
                        return Html::a('Готово', ['close']);
                   } else {
                       return '';
                   }
                },
                'contentOptions' => ['class' => 'textTr border-right tr70'],
            ]
        ],
    ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
<div class="footerNav">
    <?php echo Nav::widget([
        'options' => ['class' => 'nav nav-pills footerNav'],
        'items' => [
            ['label' => 'Архив', 'url' => ['zakaz/closezakaz'], 'visible' => Yii::$app->user->can('seeShop')],
        ],
    ]); ?>
</div>

=======
$this->title = 'Экран - ВСЕ ЗАКАЗЫ';
?>
<?php Pjax::begin(); ?>

<div class="zakaz-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo $this->render('_search', ['model' => $searchModel]);?>
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['zakaz/shop'], ['class' => 'btn btn-primary btn-lg pull-right', 'style' => 'margin-left:10px;']) ?>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success btn-lg pull-right']) ?>
    </p>
    <div class="col-xs-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-bordered'],
        'rowOptions' => ['class' => 'trTable'],
        'columns' => [
            [
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20'],
                'value' => 'prefics',
            ],
            [
                'attribute' => 'description',
                'headerOptions' => ['width' => '550'],
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            [
                'attribute' => 'fact_oplata',
                'label' => 'Предоплата',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'closePayment',
                'value' => function($model){
                return $model->fact_oplata == null ? $model->oplata - $model->fact_oplata: '0';
            },
                'headerOptions' => ['width' => '100'],
                'label' => 'К доплате',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
</div>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
