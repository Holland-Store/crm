<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Courier;
?>

<?php $this->registerJs('$("body").on("click", "#edit", function(){
           var key = $(this).data("key");
        $.ajax({
            url: "'.Url::toRoute(['zakaz/zakazedit']).'?id="+key,
            timeout: 10000,
            success: function(html){
                $(".view-zakaz").html(html);
            }
        })
    });') ?>

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
				[
                    'attribute' => 'phone',
                    'value' => '8'.$model->phone,
				],
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
    <div class="footer-view-zakaz">
        <?= Html::a('Задача', ['todoist/createzakaz', 'id_zakaz' => $model->id_zakaz]) ?>
        <?= Html::a('Запрос', ['todoist/create_shop']) ?>
        <?php Modal::begin([
            'header' => '<h2>Создание доставки</h2>',
            'toggleButton' => [
                'tag' => 'a',
                'label' => 'Доставка',
            ]
        ]);
        $shipping = new Courier();
        echo $this->render('shipping', [
           'shipping' => $shipping,
            'model' => $model->id_zakaz,
        ]);

        Modal::end(); ?>
        <?= Html::submitButton('Редактировать', ['id' => 'edit', 'data-key' => $model->id_zakaz]) ?>
    </div>
</div>
