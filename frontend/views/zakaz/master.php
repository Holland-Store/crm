<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\grid\GridView;
use app\models\Zakaz;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мастер';
?>
<?php Pjax::begin(['id' => 'pjax-container']); ?>

<div class="zakaz-index">

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
                'contentOptions' => ['class' => 'textTr tr50'],
            ],
            [
                'attribute' => 'statusMasterName',
                'contentOptions' => ['class' => 'border-right textTr tr90'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
