<?php

use app\models\Financy;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Courier;
use app\models\Comment;
use app\models\Zakaz;
use app\models\User;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;

/* @var  $comment app\models\Comment */
/* @var  $model app\models\Zakaz */
/** @var string $sotrud */
?>

<div class="view-zakaz" style="color: black">
	<div class="col-lg-2 anketaZakaz">
        <span class="anketaZakaz_from">От:</span>
        <div><?= date('d M H:i',strtotime($model->data)) ?></div>

        <span class="anketaZakaz_from">Автор:</span>
        <div><?= $model->idSotrud->name ?></div>

        <?php if ($model->sotrud_name != null): ?>
        <span class="anketaZakaz_from">Сотрудник:</span>
        <div><?= $model->sotrud_name ?></div>
        <?php endif; ?>

        <span class="anketaZakaz_from">Клиент:</span>
        <div><?= $model->name ?></div>
        <div>
            <?php $s = $model->phone;
                echo $s[0].' ('.$s[1].$s[2].$s[3].') '.$s[4].$s[5].$s[6].'-'.$s[7].$s[8].'-'.$s[9].$s[10];
            ?>
        </div>
        <div><?= $model->email ?></div>
	    </div>
    </div>
	<div class="col-lg-7 zakazInfo">
        <div class="divInform">
        <?= $model->information ?>
        </div>
        <?php Pjax::begin(['id' => 'commentPjax']) ?>
        <?php $comments = Comment::find()->where(['id_zakaz' => $model->id_zakaz])->orderBy('date DESC')->all() ?>
        <div class="comment-zakaz">
            <?php  foreach ($comments as $com){
                switch ($com->id_user){
                    case Yii::$app->user->id;
                        $user = 'Я';
                        break;
                    case (User::USER_DISAYNER);
                        $user = 'Дизайнер';
                        break;
                    case (User::USER_MASTER):
                        $user = 'Мастер';
                        break;
                }
                echo  '
<div style="display: block;">
    <div class="userCommit">'.$user.':</div>
    <div class="comment">'.$com->comment.'</div>
    <div class="dateCommit">'.date('d.m H:i', strtotime($com->date)).'</div>
</div>';
            }?>
        </div>
        <?php Pjax::end(); ?>
        <?= Html::buttonInput('Коммент', [
            'class' => 'btn btn-xs commentButton']) ?>
        <div class="CommentForm">
            <?php $formComment = ActiveForm::begin([
                    'id' => 'formComment',
                    'action' => ['comment/create'],
            ]); ?>
            <?php if ($model->status == Zakaz::STATUS_DISAIN){
                $comment->sotrud = User::USER_MASTER;
                $sotrud = $comment->sotrud;
            } elseif($model->status == Zakaz::STATUS_MASTER){
                $comment->sotrud = User::USER_DISAYNER;
                $sotrud = $comment->sotrud;
            }
            ?>
            <div class="col-lg-11">
                <?= $formComment->field($comment, 'comment')->textarea(['placeholder' => 'Комментарий', 'rows' => 1, 'class' => 'inputComment'])->label(false) ?>
                <?= $formComment->field($comment, 'id_user')->hiddenInput(['value' => Yii::$app->user->getId()])->label(false)?>
                <?= $formComment->field($comment, 'sotrud')->hiddenInput(['value' => $sotrud])->label(false)?>
                <?= $formComment->field($comment, 'id_zakaz')->hiddenInput(['value' => $model->id_zakaz])->label(false)?>
            </div>
            <div class="col-lg-1">
                <?= Html::submitButton(' <span class="glyphicon glyphicon-send"></span>', ['class' => 'btn btn-primary', 'style' => '    color: white;
    font-size: 15px;
    margin-top: 0px;
    margin-left: -30px;
    border-radius: 45px;'])?>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
	</div>
	<div class="col-lg-1 zakazFile">
        <div class="zakazFile_block">
            <span class="zakazFile_block-number">Кол-во:</span>
            <div><?= $model->number ?></div>
        </div>
		<?= Detailview::widget([
			'model' => $model,
			'options' => ['class' => 'table detail-view'],
			'template' => '<tr class="trMaket"><td{contentOptions} class="zakaz-view-kartik">{value}</td></tr></tr>',
			'attributes' => [
                [
                    'attribute' => 'maket',
                    'format' =>'raw',
                    'value' => $model->maket == null ? '<div class="maket"></div>' : Html::a('<span class="glyphicon glyphicon-saved imgZakaz maketView">', '@web/maket/'.$model->maket, ['download' => true, 'data-pjax' => 0, 'title' => 'Готовый макет от дизайнера'])
                ],
				[
				    'attribute' => 'img',
                    'format' =>'raw',
                    'value' => $model->img == null ? '' : Html::a('<span class="glyphicon glyphicon-paperclip imgZakaz"></span>', '@web/attachment/'.$model->img, ['download' => true, 'data-pjax' => 0, 'title' => 'Исходный файл от клиента'])
				],
			],
		]) ?>
	</div>
    <div class="responsible">
        <?php if (Yii::$app->user->can('disain')): ?>
            <?php if ($model->status == Zakaz::STATUS_DISAIN && $model->statusDisain == Zakaz::STATUS_DISAINER_WORK): ?>
            Согласование с клиентом: <?= Html::a('Оправить', ['reconcilation', 'id' => $model->id_zakaz], ['class' => 'action']) ?>
            <?php endif ?>
            <?php if ($model->status == Zakaz::STATUS_DISAIN && $model->statusDisain == Zakaz::STATUS_DISAINER_SOGLAS): ?>
                Согласование с клиентом: <?= Html::a('Снять', ['reconcilation', 'id' => $model->id_zakaz], ['class' => 'action']) ?>
            <?php endif ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('seeIspol')): ?>
            <div class="responsible_person-status">
                <?php if ($model->status == Zakaz::STATUS_DECLINED_DISAIN or $model->status == Zakaz::STATUS_DECLINED_MASTER){
                    echo '<div class="statusZakaz declinedIspol">Отклонено</div>
<div class="declinedIspol_div">
<span class="responsible_person">По причине:</span><br>'.$model->declined.'</div>';
                }
                ?>
            </div>
        <?php endif ?>
        <?php if (Yii::$app->user->can('admin')): ?>
        <span class="responsible_person">Статус:</span>
        <div class="responsible_person-status">
            <?php if ($model->status == Zakaz::STATUS_SUC_DISAIN or $model->status == Zakaz::STATUS_SUC_MASTER){
                echo '<div class="statusZakaz">Выполнено</div>
<div>'
                    .Html::submitButton('Принять', ['class' => 'action actionApprove', 'value' => Url::to(['zakaz/accept', 'id' => $model->id_zakaz])]).' '
                    .Html::submitButton('Отклонить', ['class' => 'action actionCancel', 'value' => Url::to(['zakaz/declined', 'id' => $model->id_zakaz])]).'
</div>';
            }
            elseif($model->status == Zakaz::STATUS_DECLINED_DISAIN or $model->status == Zakaz::STATUS_DECLINED_MASTER){
                echo '<div class="statusZakaz declined">Отклонено</div>
<div class="declined_div">
<span class="responsible_person">По причине:</span><br>'.$model->declined.'</div>';
            } elseif($model->status == Zakaz::STATUS_ADOPTED){
                echo Html::submitButton('Назначить', ['class' => 'action actionApprove appoint', 'value' => Url::to(['zakaz/accept', 'id' => $model->id_zakaz])]);
            } elseif ($model->renouncement != null){
                echo '<div class="statusZakaz declined">Отказ от клиента</div>
<div class="declined_div">
<span class="responsible_person">По причине:</span><br>'.$model->renouncement.'</div>
<div>'
    .Html::a('Принять', ['refusing', 'id' => $model->id_zakaz, 'action' => 'yes'], ['class' => 'action success']).' '
    .Html::a('Отклонить', ['refusing', 'id' => $model->id_zakaz, 'action' => 'no'], ['class' => 'action cancelButton']).
'</div>';
            } elseif ($model->status == Zakaz::STATUS_AUTSORS){
                echo '<div class="statusZakaz">'.$model->idAutsors->name.'</div>
<div>'
                    .Html::submitButton('Принять', ['class' => 'action actionApprove', 'value' => Url::to(['zakaz/accept', 'id' => $model->id_zakaz])]).'
</div>';
            }
            ?>
        </div>
        <?php endif ?>
        <div class="linePrice"></div>
        <div class="oplata-zakaz">
            <span class="responsible_person namePrice">Оплачено:</span>
            <span class="responsible_person namePrice">К доплате:</span>
            <span class="responsible_person namePrice">Всего:</span>
            <div class="responsible_person price"><?= number_format($model->fact_oplata, 0, ',', ' ').'р.' ?></div>
            <div class="responsible_person price"><?php if($model->oplata != null){?>
                <?php echo number_format($model->oplata - $model->fact_oplata, 0, ',', ' ').'р.'; ?>
            <?php } ?></div>
            <div class="responsible_person price"><?= number_format($model->oplata, 0, ',', ' ').'р.'    ?></div>
        </div>
    </div>
    <div class="col-lg-12 footerView"></div>
    <div class="col-lg-12 footer-view-zakaz">
        <?php if (($model->status == Zakaz::STATUS_MASTER or $model->status == Zakaz::STATUS_DECLINED_MASTER) && Yii::$app->user->can('master')): ?>
            <?= Html::a('Готово', ['check', 'id' => $model->id_zakaz], ['class' => 'btn btn- done']) ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('seeAdop')): ?>
            <?php if ($model->status == Zakaz::STATUS_EXECUTE && $model->action == 1 && $model->renouncement == null && $model->oplata == $model->fact_oplata): ?>
                <?= Html::a('Готово', ['close', 'id' => $model->id_zakaz], ['class' => 'btn btn-xs done']) ?>
            <?php endif ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('admin')): ?>
            <?php if($model->status == Zakaz::STATUS_ADOPTED && $model->action == 1): ?>
                <?= Html::a('Выполнить', ['fulfilled','id' => $model->id_zakaz], ['class' => 'btn btn-xs done']) ?>
            <?php endif ?>
            <?php if ($model->action == 0): ?>
                <?= Html::a('Восстановить', ['restore','id' => $model->id_zakaz], [
                        'class' => 'btn btn-xs done',
                        'data' => [
                            'confirm' => 'Вы действительно хотите восстановить заказ?',
                            'method' => 'post',
                        ],
                ]) ?>
            <?php endif ?>
        <?php endif ?>
            <?= Html::a('Задача', ['todoist/createzakaz', 'id_zakaz' => $model->id_zakaz], ['class' => 'btn btn-xs todoist']) ?>
        <?php if (Yii::$app->user->can('admin')): ?>
            <?php Modal::begin([
                'header' => '<h2>Задание на доставку</h2>',
                'class' => 'model-sm modalShipping',
                'toggleButton' => [
                    'tag' => 'a',
                    'class' => 'btn btn-xs',
                    'label' => 'Доставка',
                ]
            ]);
            $shipping = new Courier();
            echo $this->render('shipping', [
                'shipping' => $shipping,
                'model' => $model->id_zakaz,
            ]);

            Modal::end(); ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('seeAdop') && $model->renouncement == null): ?>
            <?php Modal::begin([
                'header' => 'Укажите причину отказа',
                'class' => 'modal-sm',
                'toggleButton' => [
                    'tag' => 'a',
                    'class' => 'btn action',
                    'label' => 'Отказ',
                ]
            ]);
            $declinedClient = ActiveForm::begin([
                'action' => ['renouncement', 'id' => $model->id_zakaz],
                'id' => 'renouncementForm',
            ]);
            echo $declinedClient->field($model, 'renouncement')->textInput()->label(false);
            echo Html::submitButton('Отправить', ['class' => 'btn action']);
            ActiveForm::end();
            Modal::end() ?>
        <?php endif ?>
        <?php if (($model->status == Zakaz::STATUS_DISAIN or $model->status == Zakaz::STATUS_DECLINED_DISAIN) && Yii::$app->user->can('disain')): ?>
            <?= Html::submitButton('Заказ исполнен', ['class' => 'action modalDisain', 'value' => Url::to(['uploadedisain', 'id' => $model->id_zakaz])]) ?>
        <?php endif ?>
        <?php if (!Yii::$app->user->can('seeIspol')): ?>
            <?= Html::a('Редактировать', ['zakaz/update', 'id' => $model->id_zakaz], ['class' => 'btn btn-xs', 'style' => 'float: right;margin-right: 10px;'])?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('seeAdop')): ?>
            <?php if ($model->oplata - $model->fact_oplata != 0): ?>
                <?php Modal::begin([
                    'header' => 'Оплата услуг',
                    'class' => 'modal-sm',
                    'toggleButton' => [
                        'tag' => 'a',
                        'class' => 'btn action',
                        'style' => 'float: right;margin-right: 71px;',
                        'label' => 'Чек',
                    ]
                ]);
                $financy = new Financy();
                $financy->amount = $model->oplata - $model->fact_oplata;
                /** @var $financy app\models\Financy */
                $form = ActiveForm::begin([
                    'action' => ['financy/draft', 'id' => $model->id_zakaz],
                    'id' => 'draftForm',
                ]);

                echo Html::encode('К доплате: ').number_format($model->oplata - $model->fact_oplata,0,',', ' ').' p.';
                echo $form->field($financy, 'sum')->widget(MaskedInput::className(), [
                    'clientOptions' => [
                        'alias' => 'decimal',
                        'groupSeparator' => ' ',
                        'autoGroup' => true,
                    ],
                ]);
                echo $form->field($financy, 'id_zakaz')->hiddenInput(['value' => $model->id_zakaz])->label(false);
                echo $form->field($financy, 'id_user')->hiddenInput(['value' => Yii::$app->user->id])->label(false);
                echo Html::submitButton('Зачислить', ['class' => 'btn action']);

                ActiveForm::end();
                Modal::end() ?>
            <?php endif ?>
        <?php endif; ?>
    </div>
<?php $script = <<<JS
$('#formComment').on('beforeSubmit', function(e) {
  var form = $(this);
  $.post(
      form.attr('action'),
      form.serialize()
  )
    .done(function(result) {
      if (result == true)
          {
              $.pjax.reload({container: '#commentPjax'});
              $('#formComment').trigger('reset');
          } else {
            return false
          }
    }).fail(function() {
      console.log('server error');
    });
return false;
});
JS;
$this->registerJS($script); ?>
