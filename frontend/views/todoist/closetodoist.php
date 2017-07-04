<?php

use yii\helpers\Html;
<<<<<<< HEAD
use kartik\grid\GridView;
=======
use yii\grid\GridView;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodoistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Архив задач';
?>
<div class="todoist-close">

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
                'attribute' => 'srok',
                'format' => ['date', 'php:d M'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-left textTr tr90', 'style' => 'border:none'],
            ],
            [
                'attribute' => 'comment',
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
=======
$this->title = 'Выполненые задачи';
?>
<div class="todoist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'srok',
                'format' => ['date', 'php:d.m.Y'],
            ],
            [
                'attribute' => 'activate',
                'value' => function($model){
                    return $model->todoistName;
                }
            ],
            'typ',
            [
				'attribute' => 'id_user',
				'value' => function($model){
					return $model->idUser->name;
				}
			],
            'comment:ntext',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
            [
                'attribute' => 'zakaz',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->id_zakaz != null) {
                        return Html::a($model->idZakaz->prefics, ['zakaz/view', 'id' => $model->id_zakaz]);
                    }
                    return '';
                },
                'label' => 'Заказ',
<<<<<<< HEAD
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr50'],
            ],
            [
                'attribute' => 'id_user',
                'value' => function($model){
                    return $model->idUser->name;
                },
                'contentOptions' => ['class' => 'border-right textTr'],
            ],
=======
            ],


//            ['class' => 'yii\grid\ActionColumn'],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?>
</div>
