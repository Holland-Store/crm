<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $model app\models\Helpdesk */
?>

<?php $form = ActiveForm::begin([]); ?>

<?= $form->field($model, 'declined')->textInput()->label(false) ?>

<?= Html::submitButton('Отправить', ['class' => 'action'])?>

<?php ActiveForm::end()?>