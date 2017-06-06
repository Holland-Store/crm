<?php

use yii\helpers\StringHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
// use yii\grid\SetColumn;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
        'floatHeader' =>true,
        'tableOptions' => ['class' => 'table table-bordered tableSize'],
        'headerRowOptions' => ['style' => 'display:none'],
        'pjax' => true,
        'rowOptions' => ['class' => 'trTabl srok    '],
        'striped' => false,
        'hover' => true,
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
                'value' => 'prefics',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr', 'style' => 'width:50px;'],
            ],
            [
                'attribute' => 'status',
                'contentOptions' => ['style' => 'width:90px;'],
                'value' => function($model){
                    return $model->status == 1 ? 'Исполнен' : 'В работе';
                },
            ],
            [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d M H:i'],
                'value' => 'srok',
                'headerOptions' => ['width' => '90'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr', 'style' => 'width:90px;'],
            ],
            [
                'attribute' => 'minut',
                'headerOptions' => ['width' => '10'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr', 'style' => 'width:10px;'],
            ],
            [
                'attribute' => 'description',
                'value' => function($model){
                    return StringHelper::truncate($model->description, 100);
                }
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '70'],
                'value' => function($model){
                    return $model->oplata.' р.';
                },
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr', 'style' => '70px;'],
            ],
            [
                'attribute' => 'closePayment',
                'value' => function($model){
                return $model->fact_oplata == null ? $model->oplata - $model->fact_oplata: '0';
            },
                'contentOptions' => ['style' => 'border-radius: 0px 19px 18px 0px;width:70px;'],
                'label' => 'К доплате',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
</div>
