<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\ZakazSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-search">
<<<<<<< HEAD
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['']]); ?>

    <?= $form->field($model, 'search')->textInput(['class' => 'form-control'])->label(false) ?>
    
    <?= Html::submitButton('Найти') ?>

    <?php ActiveForm::end(); ?>
=======

    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['']]); ?>

    <?= $form->field($model, 'search')->textInput() ?>
    
    <div class="form-group col-xs-3" style="margin-top: 24px;">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
</div>
