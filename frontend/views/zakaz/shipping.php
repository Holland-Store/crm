<<<<<<< HEAD
<?php
=======
<?php 
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
// use app\models\Courier;
// use yii\models\Zakaz;
?>

<div class="zakaz-shippingForm">
	<?php $f = ActiveForm::begin(); ?>

<<<<<<< HEAD
	<?= $f->field($shipping, 'id_zakaz')->hiddenInput(['value' => $model])->label(false) ?>

    <?= $f-> field($shipping, 'commit')->textInput(['placeholder' => 'Что', 'class' => 'inputForm', 'style' => 'float:left'])->label(false) ?>

	<?= $f->field($shipping, 'date')->textInput(['type' => 'date', 'placeholder' => 'Что', 'class' => 'inputForm', 'style' => 'float:left;width: 39%;'])->label(false) ?>

	<?= $f->field($shipping, 'to')->textInput(['placeholder' => 'Откуда', 'class' => 'inputForm', 'style' => 'margin-top: 25px;'])->label(false) ?>

	<?= $f->field($shipping, 'from')->textInput(['placeholder' => 'Куда', 'class' => 'inputForm'])->label(false) ?>

	<div class="form-group">
		<?= Html::submitButton('Отправить', ['class' => 'action']) ?>
=======
	<?= $f->field($shipping, 'id_zakaz')->hiddenInput(['value' => $model->id_zakaz])->label(false) ?>

	<?= $f->field($shipping, 'date')->widget(
		DatePicker::className(), [
			'inline' => false,
			'clientOptions' => [
				'autoclose' => true,
				'format' => 'yyyy-mm-dd'
			]
		])->label('Дата выполение доставки') ?>

	<?= $f->field($shipping, 'to')->textInput() ?>

	<?= $f->field($shipping, 'from')->textInput() ?>

	<?= $f-> field($shipping, 'commit')->textInput()->label('Доп.указания (только для курьера)') ?>

	<div class="form-group">
		<?= Html::submitButton('Создать доставку', ['class' => 'btn btn-primary']) ?>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
	</div>


	<?php ActiveForm::end(); ?>
</div>
