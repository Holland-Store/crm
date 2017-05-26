<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\grid\SetColumn;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мастер';
?>
<?php Pjax::begin(); ?>
<?php echo Nav::widget([
    'options' => ['class' => 'nav nav-pills'],
    'items' => [
    ['label' => 'Мастер', 'url' => ['zakaz/master']],
	['label' => 'Задачник', 'url' => ['todoist/shop']],
	['label' => 'Help Desk', 'url' => ['helpdesk/index']],
    ],
]); ?>
<div class="zakaz-index">

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
    	<?= Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['zakaz/master'], ['class' => 'btn btn-primary btn-lg pull-right']) ?>
    </p>

    <?php Pjax::end(); ?>
    <?php Pjax::begin(['id' => 'pjax-container']) ?>

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
                'attribute' => 'description',
                'headerOptions' => ['width' => '550'],
                'contentOptions'=>['style'=>'white-space: normal;'],
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
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
