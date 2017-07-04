<?php

use yii\helpers\Html;
<<<<<<< HEAD
use yii\helpers\StringHelper;
use kartik\grid\GridView;
use app\models\Zakaz;
use yii\bootstrap\Modal;
=======
use yii\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\grid\SetColumn;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Все заказы';
=======
$this->title = 'Мастер';
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
?>
<?php Pjax::begin(['id' => 'pjax-container']); ?>

<div class="zakaz-index">

<<<<<<< HEAD
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
        'rowOptions' => function($model, $key, $index, $grid){
            if ($model->statusMaster == Zakaz::STATUS_MASTER_NEW) {
                return ['class' => 'trTable trNormal trNewMaster'];
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
                'contentOptions' => ['class' => 'textTr tr70'],
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
                'contentOptions' => ['class' => 'textTr tr70'],
            ],
            [
                'attribute' => 'statusMasterName',
                'contentOptions' => ['class' => 'border-right textTr tr90'],
            ],
=======
    <h1><?= Html::encode($this->title) ?></h1>
    <!-- <?php 
    Modal::begin([
    		'toggleButton' => [
    			'tag' => 'button',
    			'class' => 'btn btn-info',
    			'label' => 'Фильтр',
    		]
    	]);
    // echo $this->render('_search', ['model' => $searchModel]);
    Modal::end();
    ?> -->

    <p>
    	<?= Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['zakaz/master'], ['class' => 'btn btn-primary btn-lg pull-right']) ?>
    </p>

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
                'attribute' => 'prioritet',
                'value' => 'prioritetName',
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
                'headerOptions' => ['width' => '10'],
            ],
            'number',
            'img',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
