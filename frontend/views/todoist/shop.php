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

    <?php echo Nav::widget([
    'options' => ['class' => 'nav nav-pills'],
    'items' => [
		['label' => 'Администратор', 'url' => ['zakaz/admin'], 'visible' => Yii::$app->user->can('seeAdmin')],
		['label' => 'Дизайнер', 'url' => ['zakaz/disain'], 'visible' => Yii::$app->user->can('seeDisain')],
		['label' => 'Готовые заказы', 'url' => ['zakaz/ready'], 'visible' => Yii::$app->user->can('disain')],
		['label' => 'Мастер', 'url' => ['zakaz/master'], 'visible' => Yii::$app->user->can('master')],
		['label' => 'Прием заказов', 'url' => ['zakaz/shop'], 'visible' => Yii::$app->user->can('seeShop')],
		['label' => 'Закрытые заказы', 'url' => ['zakaz/archive'], 'visible' => Yii::$app->user->can('seeAdmin')],
		['label' => 'Курьер', 'url' => ['courier/index'], 'visible' => Yii::$app->user->can('courier')],
		['label' => 'Закрытые заказы', 'url' => ['zakaz/closezakaz'], 'visible' => Yii::$app->user->can('seeShop')],
		['label' => 'Прочее', 'items' => [
			['label' => 'Задачи', 'url' => ['todoist/shop']],
			['label' => 'Help Desk', 'url' => ['helpdesk/index']],
			['label' => 'Запросы на товар', 'url' => ['custom/adop']],
		], 'visible' => !(Yii::$app->user->can('zakup')or Yii::$app->user->can('disain') or Yii::$app->user->can('master'))],
		['label' => 'Создать запрос', 'url' => ['todoist/create_shop'], 'visible' => Yii::$app->user->can('shop')],
		['label' => 'Задачи', 'url' => ['todoist/shop'], 'visible' => (Yii::$app->user->can('seeAllIspol'))],
		['label' => 'Help Desk', 'url' => ['helpdesk/index'], 'visible' => Yii::$app->user->can('zakup')],
		['label' => 'Запросы на товар', 'url' => ['custom/index'], 'visible' => Yii::$app->user->can('zakup')],
		['label' => 'Help Desk', 'url' => ['helpdesk/index'], 'visible' => Yii::$app->user->can('seeIspol')],
		],
	]); ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
						return Html::a('Выполнить', ['close', 'id' => $model->id]);
				}
			]


//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
