<?php
use kartik\form\ActiveForm;
use phpnt\ICheck\ICheck;
use yii\helpers\Html;
use yii\widgets\MaskedInput;
?>

<?php $form = ActiveForm::begin([
    'id' => 'financy'
]) ?>

<?= $form->field($model, 'id_user')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
<?= $form->field($model, 'category')->widget(ICheck::className(), [
    'type'  => ICheck::TYPE_RADIO_LIST,
    'style'  => ICheck::STYLE_SQUARE,
    'items'    => [1 => 'Штраф', 2 => 'Преия'],
    'color'  => 'blue',
    'options' => [
        'value' => 1
    ]
])->label(false) ?>

<?= $form->field($model, 'sum')->widget(MaskedInput::className(), [
    'clientOptions' => [
        'alias' => 'decimal',
        'groupSeparator' => ' ',
        'autoGroup' => true,
    ],
    'options' => ['placeholder' => 'Сумма', 'class' => 'moneyField'],
]) ?>
<?= $form->field($model, 'comment')->textInput() ?>

<?= Html::submitButton('Назначить', ['class' => 'btn action']) ?>

<?php ActiveForm::end() ?>

