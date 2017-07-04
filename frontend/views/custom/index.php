<?php

use yii\helpers\Html;
<<<<<<< HEAD
use kartik\grid\GridView;
=======
use yii\grid\GridView;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Все запросы';
?>
<div class="custom-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
        'rowOptions' => ['class' => 'trTable trNormal'],
        'striped' => false,
        'columns' => [
            [
				'attribute' => 'date',
				'format' => ['datetime', 'php:d M H:m'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-left textTr tr90', 'style' => 'border:none'],
			],
            [
                'attribute' => 'tovar',
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            [
                'attribute' => 'number',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions'=>['class' => 'textTr tr20'],
            ],
            [
                'attribute' => 'id_user',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions'=>['class' => 'textTr tr20'],
                'value' => function($model){
                    return $model->idUser->name;
                }
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'contentOptions'=>['class' => 'border-right textTr tr50'],
                'value' => function($model) {
					if(Yii::$app->user->can('zakup')){

						return $model->action == 0 ? Html::a('Отправить', ['custom/close', 'id' => $model->id]) : '';
					} else {
						return false;
=======
$this->title = 'Запросы';
?>
<div class="custom-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
				'attribute' => 'date',
				'format' => ['datetime', 'dd.MM.Y H:m'],
			],
            [
				'attribute' => 'id_user',
				'value' => function($model){
					return $model->idUser->name;
				}
			],
            'tovar',
            'number',
            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function($model) {
					if(Yii::$app->user->can('zakup')){
						return Html::a('Привезен', ['custom/close', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']);
					} else {
						return '';
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
					}
                },
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
