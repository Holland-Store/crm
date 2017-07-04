<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
<<<<<<< HEAD
use unclead\multipleinput\TabularInput;
=======
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32

/* @var $this yii\web\View */
/* @var $model app\models\Custom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="custom-form">

<<<<<<< HEAD
    <?php $form = ActiveForm::begin([
        'enableAjaxValidation'      => true,
        'enableClientValidation'    => false,
        'validateOnChange'          => false,
        'validateOnSubmit'          => true,
        'validateOnBlur'            => false,
    ]); ?>
    <div id="customForm">

        <?=
        TabularInput::widget([
            'models' => $models,
            'columns' => [
                [
                    'name' => 'tovar',
                    'type' => \unclead\multipleinput\MultipleInputColumn::TYPE_TEXT_INPUT,
                    'title' => 'Товар',
                    'options' => [
                        'maxlength' => '50',
                        'placeholder' => 'Максимальное значение должно быть не больше 50 символов',
                    ]
                ],
                [
                    'name' => 'number',
                    'type' => 'textInput',
                    'title' => 'Кол-во',
                    'options' => [
                        'type' => 'number',
                        'min' => '0'
                    ]
                ],
            ],
        ]) ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-success']) ?>
=======
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tovar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput(['type' => 'number', 'min' => '0']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
    </div>

    <?php ActiveForm::end(); ?>

</div>
