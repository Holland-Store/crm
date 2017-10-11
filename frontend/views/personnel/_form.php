<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Personnel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personnel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), [
        'mask' => '8(999)999-99-99',
    ]) ?>

    <?= $form->field($model, 'job_duties')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shedule')->dropDownList([
        '1' => '2/2',
        '2' => '5/2'],
        ['prompt' => 'Выберите график работы'
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bonus')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
