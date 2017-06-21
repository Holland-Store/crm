<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы';?>
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
            'tovar',
            'number',
            [
                'attribute' => 'action',
                'value' => function($model){
                    return $model->action == 0 ? 'В процессе' : 'Привезен';
                },
            ],
            [
                'header' => 'Действие',
                'format' => 'raw',
                'value' => function($model){
                    return $model->action == 0 ? Html::a('Привезен', ['brought', 'id' => $model->id]) : '';
                }
            ],
        ],
    ]); ?>
</div>
