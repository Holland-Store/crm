<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

?>
<div class="view-zakaz" style="color: black">
	<div class="col-lg-2">
		<?= Detailview::widget([
			'model' => $model,
			'template' => '<tr style="color:black"><td{contentOptions}>{value}</td></tr></tr>',
			'attributes' => [
				[
					'attribute' => 'data',
					'format' => ['date','d.MM.Y H:i'],
				],
				[
					'attribute' => 'id_sotrud',
					'value' => $model->idSotrud->name
				],
				'name',
				'phone',
				'email',
			],
		]) ?>
	</div>
	<div class="col-lg-7">
		<?= Detailview::widget([
			'model' => $model,
			'template' => '<tr style="color:black"><td{contentOptions}>{value}</td></tr></tr>',
			'attributes' => [
				'information',
				'number',
				'id_tovar',
			],
		]) ?>
	</div>
	<div class="col-lg-3">
		<?= Detailview::widget([
			'model' => $model,
			'template' => '<tr style="color:black"><td{contentOptions}>{value}</td></tr></tr>',
			'attributes' => [
				'statusName',
				[
					'attribute' => 'id_shipping',
					'value' => $model->idShipping->dostavkaName,
				],
				'img',
				'maket',
			],
		]) ?>
	</div>
</div>
<div class="footer-view-zakaz">
	<?= Html::a('Задача', ['todoist/index', 'id' => $model->id_zakaz]) ?>
	<?= Html::a('Запрос', ['custom/index']) ?>
	<?= Html::a('Доставка', ['courier/create']) ?>
	<?= Html::button('Редактировать', ['id' => 'edit']) ?>
</div>
