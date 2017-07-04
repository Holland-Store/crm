<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Todoist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="todoist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'srok')->widget(
        DatePicker::className(), [
            'inline' => false, 
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ])?>

    <!-- <?= $form->field($model, 'id_zakaz')->textInput() ?> -->

    <?= $form->field($model, 'id_user')->dropDownList([
<<<<<<< HEAD
        '2' => 'Мск',
        '6' => 'Пшк',
		'9' => 'Сиб',
=======
        '2' => 'Московский',
        '6' => 'Пушкино',
		'9' => 'Сибирский',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
		'4' => 'Дизайнер',
		'3' => 'Мастер',
		'10' => 'Закупщику',
],
        ['prompt' => 'Выберите кому назначить',
    ]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
