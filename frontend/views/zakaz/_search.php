<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ZakazSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-search">

    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>

    <!-- <?= $form->field($model, 'id_zakaz') ?> -->

    <?= $form->field($model, 'srok')->widget(
        DatePicker::className(), [
            'inline' => false, 
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ]);?>

    <?php if (Yii::$app->user->can('admin')): ?>
    <?= $form->field($model, 'id_sotrud') ?>
    <?php endif ?>

    <?= $form->field($model, 'prioritet') ?>

    <?php if (Yii::$app->user->can('admin')): ?>
    <?= $form->field($model, 'status') ?>
    <?php endif ?>

    <?= $form->field($model, 'phone') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
