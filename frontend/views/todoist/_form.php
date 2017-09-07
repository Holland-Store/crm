<?php

use app\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Todoist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="todoist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'srok')->widget(
        DatePicker::className(), [
            'pluginOptions' => [
                'autoclose'=>true,
                'startDate' => 'yyyy-mm-dd',
                'todayBtn' => true,
                'todayHighlight' => true,
            ]
    ])?>

    <!-- <?= $form->field($model, 'id_zakaz')->textInput() ?> -->

    <?= $form->field($model, 'id_user')->dropDownList(
            ArrayHelper::map(User::find()->andWhere(['<>', 'id', User::USER_ALBERT])
            ->andWhere(['<>', 'id', User::USER_DAMIR])
            ->andWhere(['<>', 'id', User::USER_PROGRAM])
            ->andWhere(['<>', 'id', 8])
            ->all(),
            'id', 'name'),
        ['prompt' => 'Выберите кому назначить']
    ) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'id_sotrud_put')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
