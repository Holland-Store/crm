<?php

<<<<<<< HEAD
use app\models\Courier;
use yii\helpers\Html;
use kartik\grid\GridView;
=======
use yii\helpers\Html;
use app\models\Courier;
// use app\models\Zakaz;
use yii\grid\GridView;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CourierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Готовые доставки';
?>
<?php Pjax::begin(); ?>  

<div class="courier-index">

<<<<<<< HEAD
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
                'attribute' => 'id_zakaz',
                'value' => 'idZakaz.prefics',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-left textTr tr50', 'style' => 'border:none'],
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d M'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr70'],
            ],
            [
                'attribute' => 'commit',
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            [
                'attribute' => 'to',
                'hAlign' => GridView::ALIGN_RIGHT,
                'format' => 'raw',
                'value' => function($courier){
                    return '<span class="shipping">Откуда: </span>'.$courier->to ;
                },
                'contentOptions' => ['class' => 'textTr tr180'],
            ],
            [
                'attribute' => 'from',
                'hAlign' => GridView::ALIGN_RIGHT,
                'format' => 'raw',
                'contentOptions' => ['class' => 'textTr tr180'],
                'value' => function($courier){
                    return '<span class="shipping">Куда: </span>'.$courier->from ;
                },
            ],
            [
                'attribute' => 'status',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-right textTr tr50'],
                'value' => function($model){
                    return $model->status == Courier::CANCEL ? 'Отменена' : '';
                }
            ]
=======
    <h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'id_zakaz',
                'format' => 'text',
                // 'value' => 'idZakaz.description',
                'value' => $model->idZakaz->description,
            ],
            'to',
            'from',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
