<?php
use kartik\file\FileInput;
use kartik\form\ActiveForm;
use kartik\helpers\Html;
?>

<div class="zakaz-upload">
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'file')->widget(FileInput::className(), [

    ]) ?>

    <?php ActiveForm::end() ?>
</div>
