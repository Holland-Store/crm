<?php

use yii\helpers\Html;
use app\models\Courier;
use app\models\Zakaz;
<<<<<<< HEAD
use kartik\grid\GridView;
=======
use yii\grid\GridView;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CourierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Все доставки';
=======
$this->title = 'Доставка';
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
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
<<<<<<< HEAD
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
                'contentOptions' => ['class' => 'border-left textTr tr70', 'style' => 'border:none'],
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
                'format' => 'raw',
                'value' => function($courier){
                    return '<span class="shipping">Откуда: </span>'.$courier->to ;
                },
                'contentOptions' => ['class' => 'textTr tr202'],
            ],
            [
                'attribute' => 'from',
                'format' => 'raw',
                'contentOptions' => ['class' => 'textTr tr180'],
                'value' => function($courier){
                    return '<span class="shipping">Куда: </span>'.$courier->from ;
                },
            ],
            [
                'format' => 'raw',
                'value' => function($model, $key){
                    if ($model->status == Courier::DOSTAVKA) {
                        return Html::a('Забрать', ['make', 'id' => $model->id]);
                    } elseif($model->status == Courier::RECEIVE) {
                        return Html::a('Доставил', ['delivered', 'id' => $model->id]);
                    } elseif($model->status == Courier::CANCEL){
                        return 'Доставка отменена';
                    }
                },
                'contentOptions' => ['class' => 'border-right textTr tr50'],
=======
        'filterModel' => $searchModel,
        'columns' => [
            'id_zakaz',
            [
                'attribute' => 'id_zakaz',
                'format' => 'text',
                'value' => 'idZakaz.description',
				'contentOptions'=>['style'=>'white-space: normal;'],
                'label' => 'Описание',
                'filter' => false,
            ],
			[
				'attribute' => 'date',
				'format' => ['date', 'd.m.Y'],
			],
            'to',
            'from',
            'commit',
            [
                'format' => 'raw',
                'value' => function($model, $key){
                    if ($model->data_to == '0000-00-00 00:00:00') {
                        return Html::a('Забрать', ['make', 'id' => $model->id], ['class' => 'btn btn-ptimary']);
                    } else {
                        return Html::a('Доставил', ['delivered', 'id' => $model->id], ['class' => 'btn btn-ptimary']);
                    }
                }
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<<<<<<< HEAD
<div class="footerNav">
    <?php echo Nav::widget([
        'options' => ['class' => 'nav nav-pills footerNav'],
        'items' => [
            ['label' => 'Архив', 'url' => ['courier/ready'], 'visible' => Yii::$app->user->can('courier')],
        ],
    ]); ?>
</div>
=======
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
