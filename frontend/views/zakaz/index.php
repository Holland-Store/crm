<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zakaz-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_zakaz',
             [
                'attribute'=>'srok',
                'format'=>['datetime', 'php:d.m.Y H:i']
            ],
            'id_sotrud',
            'prioritet',
            'status',
            'id_tovar',
            [
                'attribute'=>'oplata',
                'format'=>['decimal',2]
            ],
            'number',
            [
                'attribute'=>'data',
                'format'=>['date', 'php:d.m.Y']
            ],
            'description',
            'information',
            'id_client',
            'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
