<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use app\models\Tovar;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id_zakaz')->textInput() ?> -->

    <!-- <?= $form->field($model, 'srok')->textInput() ?> -->
    <?= $form->field($model, 'srok')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => false, 
             // modify template for custom rendering
            // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ]);?>

    <?= $form->field($model, 'minut')->widget(MaskedInput::className(),[
        'mask' => '99:99'
    ]) ?>

    <?= $form->field($model, 'id_sotrud')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

   <!--  <?= $form->field($model, 'prioritet')->textInput(['maxlength' => true]) ?> -->

    <?php if (Yii::$app->user->can('admin')) {
        echo $form->field($model, 'status')->dropDownList([
        '0' => 'Новый',
        '1' => 'Исполнен',
        '2' => 'Принят',
        '3' => 'Дизайнер',
        '4' => 'Отклонен дизайнером',
        '5' => 'Мастер',
        '6' => 'Аутсорс',
        ],
        ['prompt' => 'Выберите товар']);
        } ?>

    <? if (Yii::$app->user->can('admin')) {
        echo $form->field($model, 'id_tovar')->dropDownList(
            ArrayHelper::map(Tovar::find()->all(), 'id', 'name'),
        ['prompt' => 'Выберите товар']);
    } ?>

    <?= $form->field($model, 'oplata')->textInput(['type' => 'number', 'min' => '0']) ?>

     <?= $form->field($model, 'fact_oplata')->textInput(['type' => 'number', 'min' => '0']) ?>

    <?= $form->field($model, 'number')->textInput(['type'=>'number','min' => '0']) ?>

    <?= $form->field($model, 'data')->widget(
        DatePicker::className(), [
            // inline too, not bad
             'inline' => false, 
             // modify template for custom rendering
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
    ]);?>
    <!-- <?= $form->field($model, 'img')->fileInput() ?> -->

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'information')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
        'mask' => '89999999999'
    ]) ?>

    <?= $form->field($model, 'email')->widget(MaskedInput::className(),[
        'clientOptions' => ['alias' => 'email']
    ]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?php if (Yii::$app->user->can('admin')) {
      echo $form->field($model, 'action')->dropDownList([
        '0' => 'Закрыть'
    ],
    ['prompt' => 'Укажите список при закрытие товара'])->label('Закрытие товара');  
    } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
