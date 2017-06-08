<?php
use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\money\MaskMoney;
use yii\widgets\InputWidget;
use yii\i18n\Formatter;

?>

<?= DetailView::widget([
	'model' => $model,
	'condensed' => true,
	'rowOptions' => ['style' => 'font-size: 11px;'],
	'panel' => [
		'heading' => $model->description,
        'type' => DetailView::TYPE_PRIMARY,
    ],
	'attributes' => [
		[
					'group' => true,
					'label' => 'Информация о заказе',
					'rowOptions' => ['class' => 'info'],
					'groupOptions' => ['style' => 'color:black']
		],
		[
			'attribute' => information,
			'columns' => [
				[
					'attribute' => 'number',
					'labelColOptions' => ['style' => 'width:10%;color:black'],
					'valueColOptions' => ['style' => 'width:5%;color:black'],
					'type' => DetailView::INPUT_HTML5_INPUT,
					'inputType' => 'number',
					'options' => ['min' => 0],
				],
				[
					'attribute' => 'data',
					'format' => ['date', 'd.MM.Y'],
					'labelColOptions' => ['style' => 'width:10%;color:black'],
					'valueColOptions' => ['style' => 'width:5%;color:black'],
					'displayOnly'=>true,
				],
				[
					'attribute' => 'information',
					'format' => 'text',
					'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
					'labelColOptions' => ['style' => 'color:black'],
					'valueColOptions' => ['style' => 'color:black'],
				],
				// [
				// 	'attribute' => 'srok',
				// 	'format' => ['date','d.MM.Y'],
				// 	'labelColOptions' => ['style' => 'width:5%; color:black'],
				// 	'valueColOptions' => ['style' => 'width:5%; color:black'],
				// ],
				[
					'attribute' => 'img',
					'format' => 'raw',
					'value' => $model->img == null ? '' : Html::a($model->img, '@web/attachment/'.$model->img, ['download' => true, 'data-pjax' => 0]),
					'labelColOptions' => ['style' => 'width:10%;color:black'],
					'valueColOptions' => ['style' => 'width:5%;color:black'],
					'type' => DetailView::INPUT_FILE,
				],
			],
			[
				'attribute' => prioritetName,
			],
		],
		[
			'group' => true,
			'label' => 'Клиент',
					'rowOptions' => ['class' => 'info'],
					'groupOptions' => ['style' => 'color:black'],

		],
		[
			'attribute' => client,
			'columns' => [
				[
					'attribute' => 'name',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],

				],
				[
					'attribute' => 'phone',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],
				],
				[
					'attribute' => 'email',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],
					'type' => DetailView::INPUT_HTML5_INPUT,
					'inputType' => 'email',
				],
			],
		],
		[
			'group' => true,
			'label' => 'Оплата',
					'rowOptions' => ['class' => 'info'],
					'groupOptions' => ['style' => 'color:black'],

		],
		[
			'attribute' => oplate,
			'columns' => [
				// [
				// 	'attribute' => 'oplata',
				// 	'labelColOptions' => ['style' => 'width:5%;color:black'],
				// 	'valueColOptions' => ['style' => 'color:black'],

				// ],
				[
					'attribute' => 'fact_oplata',
					'label' => 'Предоплата',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],
					'value' => $model->fact_oplata == null ? '' : $model->fact_oplata.' руб.',
					'type' => DetailView::INPUT_HTML5_INPUT,
					'inputType' => 'number',
					'options' => ['min' => 0],
				],
				[
					'attribute' => 'fact_oplata',
					'label' => 'К доплате',
					'value' => $model->oplata != null ? $model->oplata - $model->fact_oplata.' рублей' : '',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],
					'type' => DetailView::INPUT_HTML5_INPUT,
					'inputType' => 'number',
					'options' => ['min' => 0],
				],
			],
		],
		[
			'group' => true,
			'label' => 'Управление',
					'rowOptions' => ['class' => 'info'],
					'groupOptions' => ['style' => 'color:black'],

		],
		[
			'attribute' => control,
			'columns' => [
				[
					'attribute' => 'id_tovar',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],
				],
				[
					'attribute' => 'statusName',
					'label' => 'Этап',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],
				],
				[
					'attribute' => 'sotrud_name',
					'labelColOptions' => ['style' => 'width:5%;color:black'],
					'valueColOptions' => ['style' => 'color:black'],
				],
			],
		],
		[
			'attribute' => 'id_shipping',
			'label' => 'Доставка',
			'value' => $model->idShipping->dostavkaName,
			'labelColOptions' => ['style' => 'width:5%;color:black'],
			'valueColOptions' => ['style' => 'color:black'],
			'displayOnly'=>true,
		],
	],
])  ?>
