<?php
use yii\helpers\Html;
use kartik\detail\DetailView;

?>
<div style="font-size: 11px; width: 100%;">
	<div class="col-lg-3">
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				[
					'attribute' => 'data',
					'format' => ['date', 'd.MM.Y'],
				],
				[
					'attribute' => 'prioritetName',
					'label' => 'Приоритет',
				],
			],
		]) ?>
	</div>
	<div class="col-lg-5">
		<?php //echo $model->information; ?>
		<?= DetailView::widget([
			'model' => $model,
			'panel'=>[
		        'type'=>DetailView::TYPE_INFO,
		    ],
			'attributes' => [
				[
					'attribute' => 'information',
					'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
				],
			],
		]) ?>
	</div>
	<div class="col-xs-4">
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				[
					'attribute' => 'srok',
					'format' => ['date','d.MM.Y'],
					'labelColOptions' => ['style' => 'width:20%'],
					'valueColOptions' => ['style' => 'width:20%'],
				],
				[
					'attribute' => 'minut',
					'labelColOptions' => ['style' => 'width:20%'],
					'valueColOptions' => ['style' => 'width:20%'],
				],
				[
					'attribute' => 'statusName',
					'label' => 'Этап',
					'labelColOptions' => ['style' => 'width:20%'],
					'valueColOptions' => ['style' => 'width:20%'],
				],
				[
					'attribute' => 'oplata',
					'labelColOptions' => ['style' => 'width:20%'],
					'valueColOptions' => ['style' => 'width:20%'],
				],
				[
					'attribute' => oplata,
					'columns' => [
						[
							'attribute' => 'oplata',
							'valueColOptions' => ['style' => 'width:30%']
						],
						[
							'attribute' => 'fact_oplata',
							'valueColOptions' => ['style' => 'width:30%'],
							'value' => $model->fact_oplata == null ? '': $model->fact_oplata,
						],
						[
							'attribute' => 'fact_oplata',
							'label' => 'К доплате',
							'value' => $model->oplata - $model->fact_oplata,
							'valueColOptions' => ['style' => 'width:30%'],
						],
					],
				],
			],
		]) ?>

	</div>
</div>
