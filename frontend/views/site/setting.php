<?php
/* @vat $this \yii\web\View */

use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;

/* @var $model \app\models\User */
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
    ]
]) ?>