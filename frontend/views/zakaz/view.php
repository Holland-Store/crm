<?php

use kartik\form\ActiveForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */
/* @var $comment app\models\Comment */
/* @var $commentField app\models\Comment */
/* @var $financy app\models\Financy */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->prefics;
?>
    <div class="zakaz-view">
        <?php Pjax::begin(); ?>

        <div class="col-xs-6">
        <h4>Информация о заказе</h4>
        <?= DetailView::widget([
        'model' => $model,
        'striped' => false,
        'bordered' => false,
        'condensed' => true,
        'attributes' => [
            [
                'attribute' => 'srok',
                'value' => Yii::$app->formatter->asDatetime($model->srok)
            ],
            [
                'attribute' => 'id_sotrud',
                'label' => 'Магазин',
                'value' => $model->idSotrud->name,
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'shifts_id',
                'value' => $model->shifts->idSotrud->nameSotrud
            ],
            [
                'attribute' => 'prioritetName',
                'label' => 'Приоритет',
                'value' => $model->prioritet == null ? false : $model->prioritetName,
                'visible' => Yii::$app->user->can('admin') && $model->prioritet != null,
            ],
            [
                'attribute' => 'statusName',
                'label' => 'Этап',
                'visible' => Yii::$app->user->can('admin'),
            ],
            [
                'attribute' => 'oplata',
                'visible' => Yii::$app->user->can('seeAdop'),
            ],
            [
                'attribute' => 'fact_oplata',
                'visible' => Yii::$app->user->can('seeAdop'),
            ],
            'number',
            [
                'attribute' => 'data',
                'value' => Yii::$app->formatter->asDatetime($model->data),
                'visible' => Yii::$app->user->can('seeAdop'),
            ],
            'information',
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => $model->img == null ? null : Html::a($model->img, '@web/'.$model->img, ['download' => true, 'data-pjax' => 0])
            ],
            [
                'attribute' => 'maket',
                'format' => 'raw',
                'value' => $model->maket == null ? null : Html::a($model->maket, '@web/'.$model->maket, ['download' => true, 'data-pjax' => 0]),
                'visible' => $model->maket != null
            ],
            [
                'attribute' => 'statusDisainName',
                'visible' => Yii::$app->user->can('seeDisain') && $model->statusDisain != null,
                'label' => 'Статус у дизайнера',
            ],
        ],
    ]) ?>
        </div>
        <div class="col-lg-4">
            <h4>Информация о клиенте</h4>
            <?= DetailView::widget([
                'model' => $model,
                'striped' => false,
                'bordered' => false,
                'condensed' => true,
                'attributes' => [
                    [
                        'attribute' => 'id_client',
                        'label' => 'ФИО клиента',
                        'value' => $model->idClient->fioClient
                    ],
                    [
                        'attribute' => 'id_client',
                        'label' => 'Телефон',
                        'value' => $model->idClient->phone
                    ],
                    [
                        'attribute' => 'id_client',
                        'label' => 'Эл. почта',
                        'value' => $model->idClient->email,
                        'visible' => $model->idClient->email != null
                    ],
                ]
            ]) ?>
        </div>
        <div class="col-lg-3">
            <h4>Информация о поступлений</h4>
            <?php if ($financy == null) {
                echo 'Поступлений пока нет';
            } else {
                foreach ($financy as $payment){
                    echo Yii::$app->formatter->asDatetime($payment->date).' '.$payment->sum.' руб.<br>';
                }
            } ?>
        </div>
        <div class="col-lg-5">
            <h4>Информация  доставках</h4>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'headerRowOptions' => ['class' => 'headerTable'],
                'striped' => false,
                'condensed' => true,
                'pjax' => true,
                'columns' => [
                    [
                        'attribute' => 'date',
                        'value' => function ($model){
                            return Yii::$app->formatter->asDate($model->date);
                        },
                    ],
                    'to',
                    'from',
                    'commit',
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            return $model->dostavkaName;
                        }
                    ],
                ]
            ]) ?>
        </div>
        <div class="col-lg-6">
            <h4><?= Html::encode('Комментарии') ?></h4>
            <?php Pjax::begin([
                'id' => 'commentPjax'
            ]) ?>
            <?php if ($comment == null){
                echo 'Комментариев пока нет';
            } else {
                foreach ($comment as $key=>$com){
                    echo '<b>'.Yii::$app->formatter->asDate($key, 'php:j M Y').'</b><br>';
                    foreach ($com as $value=>$name){
                        echo Yii::$app->formatter->asTime(ArrayHelper::getValue($name, 'time'), 'php:H:i').' '.ArrayHelper::getValue($name, 'comment').' '.ArrayHelper::getValue($name, 'idUser.name').'<br>';
                    }
                }
            } ?>
            <?php Pjax::end() ?>
            <?php $form = ActiveForm::begin([
                    'id' => 'formComment',
                    'action' => ['comment/zakaz'],
            ]) ?>
            <?= $form->field($commentField, 'comment')->textInput()->label(false) ?>
            <?= $form->field($commentField, 'id_zakaz')->hiddenInput(['value' => $model->id_zakaz])->label(false) ?>
            <?= $form->field($commentField, 'id_user')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
            <?= Html::submitButton('Отправить', ['class' => 'btn action']) ?>
            <?php ActiveForm::end() ?>
        </div>
        <?php Pjax::end(); ?>
    </div>
<?php $script = <<<JS
    $('#formComment').on('beforeSubmit', function(e) {
      let form = $(this);
      $.post(
          form.attr('action'),
          form.serialize()
      )
      .done(function(result) {
        if (result === true){
            $.pjax.reload({container: '#commentPjax'});
            $('#formComment').trigger('reset');
        } else {
            return false;
        }       
      }).fail(function() {
           console.log('server error');
      });
      return false
    })
JS;
$this->registerJs($script)?>
