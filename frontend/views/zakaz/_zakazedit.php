<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<div class="edit-zakaz">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-2">
        <?= $models->data ?>
        <?= $models->idSotrud->name ?>
        <?= $form->field($models, 'name')->textInput() ?>
        <?= $form->field($models, 'phone')->textInput() ?>
        <?= $form->field($models, 'email')->textInput(['type' => 'email']) ?>
    </div>
    <div class="col-lg-7">
        <?= $form->field($models, 'information')->textarea(['max' => 500]); ?>
        <?= $form->field($models, 'number')->textInput(['type' => 'number']); ?>
        <?= $form->field($models, 'file')->fileInput() ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($models, 'status')->dropDownList([
            '2' => 'Принят',
            '3' => 'Дизайнер',
            '6' => 'Мастер',
            '8' => 'Аутсорс',
            '1' => 'Исполнен',
        ])?>
        <?= $models->idShipping->dostavkaName ?>
        <?= $models->maket ?>
    </div>
    <div class="footer-edit-zakaz">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= Html::button('Вернуться', ['id' => 'view']) ?>
</div>
