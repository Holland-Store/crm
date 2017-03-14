<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id_zakaz')->textInput() ?> -->

    <?= $form->field($model, 'srok')->textInput() ?>

    <?= $form->field($model, 'id_sotrud')->textInput() ?>

    <?= $form->field($model, 'prioritet')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tovar')->textInput() ?>

    <?= $form->field($model, 'oplata')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'information')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_client')->textInput() ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
