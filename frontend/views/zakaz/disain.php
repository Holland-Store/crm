<?php

<<<<<<< HEAD
use yii\bootstrap\Modal;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\grid\GridView;
use app\models\Zakaz;
=======
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\widgets\MaskedInput;
use yii\grid\SetColumn;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Все заказы';
=======
$this->title = 'Дизайнер';
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
            if ($model->statusDisain == Zakaz::STATUS_DISAINER_NEW) {
                return ['class' => 'trTable trNormal trNewDisain'];
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
                'attribute' => 'time',
                'value' => function($model){
                    if ($model->time == null){
                        return '0 минут';
                    } else {
                        return $model->time.' минут';
                    }
                },
                'contentOptions' => ['class' => 'textTr tr70'],
            ],
            [
                'attribute' => 'statusDisainName',
                'contentOptions' => function($model) {
                    if ($model->status == Zakaz::STATUS_SUC_DISAIN) {
                        return ['class' => 'border-right textTr tr90 success-ispol'];
                    } elseif($model->status == Zakaz::STATUS_DECLINED_DISAIN) {

                        return ['class' => 'border-right textTr tr90'];
                    }
                }
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
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['zakaz/disain'], ['class' => 'btn btn-primary btn-lg pull-right']) ?>
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
                'attribute' => 'statusDisain',
                'class' => SetColumn::className(),
                'format' => 'raw',
                'name' => 'statusDisainName',
                'cssCLasses' => [
                    Zakaz::STATUS_DISAINER_NEW => 'primary',
                    Zakaz::STATUS_DISAINER_WORK => 'success',
                    Zakaz::STATUS_DISAINER_SOGLAS => 'info',
                ],
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'description',
                'contentOptions' => ['style' => 'white-space: normal;'],
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
            'time',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<<<<<<< HEAD
<div class="footerNav">
    <?php echo Nav::widget([
        'options' => ['class' => 'nav nav-pills footerNav'],
        'items' => [
            ['label' => 'Архив', 'url' => ['zakaz/ready'], 'visible' => Yii::$app->user->can('disain')],
        ],
    ]); ?>
</div>
<?php Modal::begin([
    'id' => 'modalFile',
    'size' => 'modal-sm',
    'header' => '<h2>Прикрепите макет</h2>',
]);

echo '<div class="modalContent"></div>';

Modal::end();?>
=======
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
