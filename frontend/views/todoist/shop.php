<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodoistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Задачник';
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
            // 'id_zakaz',
            'status',
            'typ',
            [
				'attribute' => 'id_user',
				'value' => function($model){
					return $model->idUser->name;
				}
			],
            'comment:ntext',
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
            ],
			[
				'attribute' => '',
				'format' => 'raw',
				'value' => function($model){
						return Html::a('Готово', ['close', 'id' => $model->id]);
				}
			]


//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
