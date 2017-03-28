<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\widgets\MaskedInput;
use yii\grid\SetColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Дизайнер';
?>
<?php echo Nav::widget([
    'options' => ['class' => 'nav nav-pills'],
    'items' => [
    ['label' => 'Главная', 'url' => ['zakaz/index']],
    ['label' => 'Администратор', 'url' => ['zakaz/admin'], 'visible' => Yii::$app->user->can('seeAdmin')],
    ['label' => 'Дизайнер', 'url' => ['zakaz/disain'], 'visible' => Yii::$app->user->can('seeDisain')],
    ['label' => 'Мастер', 'url' => ['zakaz/master'], 'visible' => Yii::$app->user->can('seeMaster')],
    ['label' => 'Магазин', 'url' => ['zakaz/shop'], 'visible' => Yii::$app->user->can('seeShop')],
    ],
]); ?>
<div class="zakaz-index">

    <h1><?= Html::encode($this->title) ?></h1>
   <?php 
    Modal::begin([
    		'toggleButton' => [
    			'tag' => 'button',
    			'class' => 'btn btn-info',
    			'label' => 'Фильтр',
    		]
    	]);
    echo $this->render('_search', ['model' => $searchModel]);
    Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20']
            ],
            [
            'attribute' => 'description',
            'headerOptions' => ['width' => '550'],
            ],
            'prioritet',
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
                'format' => ['time', 'php:H:i'],
                'headerOptions' => ['width' => '10'],
            ],
            'number',
            'img',
            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a(
                    '<button class = "btn btn-primary">Открыть</button>', 
                    $url);
                },
            ],
            ],
        ],
    ]); ?>
</div>
