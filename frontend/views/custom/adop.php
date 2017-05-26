<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CustomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Запросы';?>
<div class="custom-index">
    <?php echo Nav::widget([
		'options' => ['class' => 'nav nav-pills'],
		'items' => [
		['label' => 'Администратор', 'url' => ['zakaz/admin'], 'visible' => Yii::$app->user->can('seeAdmin')],
		['label' => 'Прием заказов', 'url' => ['zakaz/shop'], 'visible' => Yii::$app->user->can('seeShop')],
		['label' => 'Закрытые заказы', 'url' => ['zakaz/archive'], 'visible' => Yii::$app->user->can('seeAdmin')],
		['label' => 'Курьер', 'url' => ['courier/index'], 'visible' => Yii::$app->user->can('courier')],
		['label' => 'Закрытые заказы', 'url' => ['zakaz/closezakaz'], 'visible' => Yii::$app->user->can('seeShop')],
		['label' => 'Прочее', 'items' => [
			['label' => 'Задачник', 'url' => ['todoist/index'], 'visible' => Yii::$app->user->can('admin')],
			['label' => 'Задачи', 'url' => ['todoist/shop'], 'visible' => Yii::$app->user->can('shop')],
			['label' => 'Help Desk', 'url' => ['helpdesk/index']],
			['label' => 'Запросы на товар', 'url' => ['custom/adop'], 'visible' => Yii::$app->user->can('seeAdop')],
		]],
		['label' => 'Создать запрос', 'url' => ['todoist/create_shop'], 'visible' =>Yii::$app->user->can('shop')],
		],
	]); ?>

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
            'id_user',
            'tovar',
            'number',
        ],
    ]); ?>
</div>
