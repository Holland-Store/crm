<?php
/* @vat $this \yii\web\View */
/* @var $model \app\models\User */
/* @var $sotrud \app\models\Shifts */
/* @var $shifts \app\models\Shifts */
/** @var array $shifts */

use app\models\Personnel;
use kartik\detail\DetailView;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<a href="http://telegram.me/HollandSotrudbot?start=<?= $model->telegram_token; ?>" target="_blank" class="black-btn btn-lg">
    <i class="fa fa-paper-plane"></i> Подключить
</a>

<?= DetailView::widget([
    'model' => $model,
    'hover' => false,
    'mode'=>DetailView::MODE_VIEW,
    'striped' => false,
    'panel'=>[
        'heading'=>'Учетная запись для пользователя ' . $model->name,
        'type'=>DetailView::TYPE_INFO,
        'headingOptions' => ['template' => '{title}']
    ],
    'attributes' => [
        'email:email',
        'address:text',
        'phone',
        [
            'attribute' => 'otdel_id',
            'value' =>  ArrayHelper::getValue($model, 'idOtdel.name')
        ],
        [
            'attribute' => 'otdel_id',
            'value' =>  ArrayHelper::getValue($model, 'idOtdel.id'),
            'label' => '№ отдела',
        ],
        'personnelAsString',
    ]
]) ?>

<?= Html::submitButton('Начать смену', ['class' => 'btn action']); ?>
<?php if($shifts != null): ?>
<?= Html::submitButton('Закончить смену', ['class' => 'btn action']); ?>
<?php endif; ?>
<?php $form = ActiveForm::begin([
        'id' => 'form-startShift'
]); ?>

<?= $form->field($sotrud, 'id_sotrud')->dropDownList(ArrayHelper::map(Personnel::find()->where(['action' => 0])->all(), 'id', 'nameSotrud'),
    [
        'prompt' => 'Выберите сотрудника',
    ])->label(false) ?>

<?php ActiveForm::end(); ?>
<?php $form = ActiveForm::begin([
    'id' => 'form-endShift'
]); ?>
<?= $form->field($sotrud, 'id_sotrud')->dropDownList(ArrayHelper::map($shifts, 'id', 'nameSotrud'),
    [
        'prompt' => 'Выберите сотрудника',
    ])->label(false) ?>

<?php ActiveForm::end(); ?>