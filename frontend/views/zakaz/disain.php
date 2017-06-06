<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
use kartik\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\widgets\MaskedInput;
use yii\grid\SetColumn;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дизайнер';
?>
<?php Pjax::begin(['id' => 'pjax-container']); ?>

<div class="zakaz-index">

    <h1 class="titleTable"><?= Html::encode($this->title) ?></h1>
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
        'floatHeader' => true,
        'pjax' => true,
        'striped' => false,
        'hover' => true,
        'tableOptions' => ['class' => 'table table-bordered tableSize'],
        'rowOptions' => ['class' => 'trTable'],
        'columns' => [
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'contentOptions' => function($model, $key, $index, $grid){
                    return ['id' => $model->id_zakaz, 'style' => 'border-radius: 19px 0px 0px 19px;width:10px;'];
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
                'contentOptions' => ['width' => '50px'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'value' => 'prefics',
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'headerOptions' => ['width' => '20'],
                'contentOptions' => ['style' => 'width:20px;'],
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
            [
                'attribute' => 'description',
                // 'contentOptions' => ['style' => 'white-space: normal;'],
                'value' => function($model){
                    return StringHelper::truncate($model->description, 100);
                }
            ],
            // [
            //     'attribute' => 'id_tovar',
            //     'value' => 'idTovar.name',
            //     'filter' => Zakaz::getTovarList(),
            //     'headerOptions' => ['width' => '100'],
            // ],
            
            // 'number',
            // 'img',
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
                'contentOptions' => ['width' => '50px'],
            ],
            [
                'attribute' => 'time',
                'value' => function($model){
                    return $model->time.' минут';
                },
                'contentOptions' => ['style' => 'border-radius: 0px 19px 18px 0px;width:50px;'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
