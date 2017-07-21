<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\client\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
        'mask' => '89999999999',
    ]) ?>

    <?= $form->field($model, 'email')->widget(MaskedInput::className(), [
            'clientOptions' => ['alias' => 'email'],
    ]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'home')->textInput(['type' => 'number', 'min' => 0]) ?>

    <?= $form->field($model, 'apartment')->textInput(['type' => 'number', 'min' => 0]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
