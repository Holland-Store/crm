<?php

use yii\helpers\Html;
use app\models\Courier;
use app\models\Zakaz;
use kartik\grid\GridView;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CourierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доставка';
?>
<?php Pjax::begin(); ?>
<div class="courier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <div class="form-group" style="font-size: 16px;">
    <?php //ActiveForm::begin(); ?>
    <?php //foreach ($model as $shipping) {
        //echo '<div>№ заказа: '.$shipping->id_zakaz.'<br> откуда: '.$shipping->to.' <span>'.Html::submitButton('Принял', ['class' => 'btn btn-primary']).'</span><br> куда: '.$shipping->from.'<span>'.Html::submitButton('Доставил', ['class' => 'btn btn-success']).'</span><br> Информация: '.$shipping->commit.'</div><hr>';
    //}; ?>
    <?php //ActiveForm::end(); ?>
    </div> -->

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
                'contentOptions' => ['class' => 'textTr tr50'],
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
                'contentOptions' => ['class' => 'textTr tr90'],
                'value' => function($courier){
                    return '<span class="shipping">Куда: </span>'.$courier->from ;
                },
            ],
            [
                'format' => 'raw',
                'value' => function($model, $key){
                    if ($model->data_to == '0000-00-00 00:00:00') {
                        return Html::a('Забрать', ['make', 'id' => $model->id]);
                    } else {
                        return Html::a('Доставил', ['delivered', 'id' => $model->id]);
                    }
                },
                'contentOptions' => ['class' => 'border-right textTr tr50'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
