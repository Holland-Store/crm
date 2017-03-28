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

$this->title = 'Заказ';
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

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
                'attribute' => 'status',
                'class' => SetColumn::className(),
                'format' => 'raw',
                'name' => 'statusName',
                'cssCLasses' => [
                    Zakaz::STATUS_NEW => 'primary',
                    Zakaz::STATUS_EXECUTE => 'success',
                    Zakaz::STATUS_APOTED => 'warning',
                    Zakaz::STATUS_DISAIN => 'info',
                    Zakaz::STATUS_SUC_DISAIN => 'success',
                    Zakaz::STATUS_REJECT => 'danger',
                    Zakaz::STATUS_MASTER => 'info',
                    Zakaz::STATUS_SUC_MASTER => 'success',
                    Zakaz::STATUS_AUTSORS => 'info',
                ],
                'headerOptions' => ['width' => '50'],
            ],
            [
            'attribute' => 'description',
            'headerOptions' => ['width' => '550'],
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
                    // inline too, not bad
                     'inline' => false, 
                     // modify template for custom rendering
                    // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
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
            // [
            //     'attribute' => 'id_sotrud',
            //     'value' => 'idSotrud.fio',
            //     'filter' => Zakaz::getSotrudList(),
            // ],
            // 'prioritet',
            [
                'attribute' => 'fact_oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '50'],
            ],
            // 'number',
            // 'information',
            'img',
            // [
            //     'attribute' => 'name',
            // ],
            // [
            //     'attribute' => 'phone',
            // ],
            // 'comment:ntext',

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
