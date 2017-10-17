<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Courier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="courier-form">

    <?php \frontend\components\YandexMap::widget() ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->widget(
            DatePicker::className(), [
                'pluginOptions' => [
                    'autoclose' => true,
                    'startDate' => 'yyyy-mm-dd',
                    'todayBtn' => true,
                    'todayHighlight' => true,
                ]
    ]) ?>

    <?= $form->field($model, 'toYandexMap')->textInput(['maxlength' => true, 'id' => 'toMap']) ?>
    <?= $form->field($model, 'to')->hiddenInput(['maxlength' => true, 'id' => 'toInput'])->label(false) ?>
    <?= $form->field($model, 'to_name')->hiddenInput(['maxlength' => true, 'id' => 'toName'])->label(false) ?>

    <?= $form->field($model, 'fromYandexMap')->textInput(['maxlength' => true, 'id' => 'fromMap']) ?>
    <?= $form->field($model, 'from')->hiddenInput(['maxlength' => true, 'id' => 'fromInput'])->label(false) ?>
    <?= $form->field($model, 'from_name')->hiddenInput(['maxlength' => true, 'id' => 'fromName'])->label(false) ?>

    <?= $form->field($model, 'commit')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактирвовать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
