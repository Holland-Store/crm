<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\label\LabelInPlace;

/* @var $this yii\web\View */
/* @var $model app\models\Helpdesk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="helpdesk-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id_user')->textInput() ?> -->

    <?= $form->field($model, 'commetnt')->widget(LabelInPlace::className(), [
        'type' => LabelInPlace::TYPE_TEXTAREA,
        'defaultIndicators' => false
    ])->label(false) ?>

    <?= $form->field($model, 'sotrud')->widget(LabelInPlace::className(), [
        'type' => LabelInPlace::TYPE_TEXT,
        'defaultIndicators' => true,
        'encodeLabel' => false,
        'label' => '<span class="glyphicon glyphicon-user"></span> Имя сотрудника'
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
