<?php

<<<<<<< HEAD
use app\models\Zakaz;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
=======
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use yii\bootstrap\Nav;
use yii\grid\SetColumn;
use yii\widgets\Pjax;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Готовые макеты';
?>
<?php Pjax::begin(); ?>

<div class="zakaz-index">

<<<<<<< HEAD
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
                'attribute' => 'time',
                'value' => function($model){
                    return $model->time.' минут';
                },
                'contentOptions' => ['class' => 'border-right textTr tr90'],
=======
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['zakaz/disain'], ['class' => 'btn btn-primary btn-lg pull-right']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20'],
            ],
            [
            'attribute' => 'description',
            'headerOptions' => ['width' => '550'],
            ],
            'prioritet',
             [
                'attribute' => 'id_tovar',
                'value' => 'idTovar.name',
                'headerOptions' => ['width' => '100'],
            ],
            [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d.m.Y'],
                'headerOptions' => ['width' => '70'],
            ],
            [
                'attribute' => 'minut',
                'format' => ['time', 'php:H:i'],
                'headerOptions' => ['width' => '10'],
            ],
            'number',
            'img',
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a(
                    'Открыть', 
                    $url, ['class' => 'btn btn-primary']);
                },
                ],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
