<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Courier;
use app\models\Comment;
use app\models\Zakaz;

/* @var $this yii\web\View */
/* @var $shipping app\models\Courier */
/* @var $model app\models\Zakaz */
?>


<div class="view-zakaz" style="color: black">
	<div class="col-lg-2 anketaZakaz">
        <span class="anketaZakaz_from">От:</span>
        <div><?= date('d M H:i',strtotime($model->data)) ?></div>

        <span class="anketaZakaz_from">Автор:</span>
        <div><?= $model->idSotrud->name ?></div>

        <span class="anketaZakaz_from">Клиент:</span>
        <div><?= $model->name ?></div>
        <div><?php $s = $model->phone;
        echo $s[0].' ('.$s[1].$s[2].$s[3].') '.$s[4].$s[5].$s[6].'-'.$s[7].$s[8].'-'.$s[9].$s[10]; ?></div>
        <div><?= $model->email ?></div>
	    </div>
    </div>
	<div class="col-lg-7 zakazInfo">
        <div class="divInform">
        <?= $model->information ?>
        </div>
        <?php $comments = Comment::find()->where(['id_zakaz' => $model->id_zakaz])->all(); ?>
        <div class="comment-zakaz">
            <?php  foreach ($comments as $com){
                switch ($com->id_user){
                    case Yii::$app->user->id;
                        $user = 'Я';
                        break;
                    case (3);
                        $user = 'Дизайнер';
                        break;
                    case (4):
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
<!--        --><?//= Html::buttonInput('Коммент', [
//            'class' => 'btn btn-xs',
//            'style' => '    padding-left: 13px;
//                            padding-right: 13px;
//                            float: right;
//                            margin-top: -10px;
//                            margin-right: 18px;
//                            font-size: 11px;
//                            background: #3a3331;
//                            border-radius: 26px;
//                            color: #736a50;']) ?>
<!--        <div>-->
<!--            --><?php //$formComment = ActiveForm::begin([
//                    'id' => 'formComment',
//            ]); ?>
<!--            --><?php //if ($model->status == 3){
//                $comment->sotrud = 3;
//                $sotrud = $comment->sotrud;
//            } elseif($model->status == 4){
//                $comment->sotrud = 4;
//                $sotrud = $comment->sotrud;
//            }
//            ?>
<!--            <div class="col-lg-11">-->
<!--                --><?//= $formComment->field($comment, 'comment')->textarea(['placeholder' => 'Комментарий', 'rows' => 1])->label(false) ?>
<!--                --><?//= $formComment->field($comment, 'id_user')->hiddenInput(['value' => Yii::$app->user->getId()])->label(false)?>
<!--                --><?//= $formComment->field($comment, 'sotrud')->hiddenInput(['value' => $sotrud])->label(false)?>
<!--                --><?//= $formComment->field($comment, 'id_zakaz')->hiddenInput(['value' => $model->id_zakaz])->label(false)?>
<!--            </div>-->
<!--            <div class="col-lg-1">-->
<!--                --><?//= Html::submitButton(' <span class="glyphicon glyphicon-send"></span>', ['class' => 'btn btn-primary', 'style' => '    color: white;
//    font-size: 15px;
//    margin-top: 0px;
//    margin-left: -30px;
//    border-radius: 45px;'])?>
<!---->
<!--            </div>-->
<!--            --><?php //ActiveForm::end(); ?>
<!--        </div>-->
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
            Согласование с клиентом: <?= Html::a('Отправить', ['reconcilation', 'id' => $model->id_zakaz], ['class' => 'action']) ?>
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
            <div class="responsible_person price"><?= number_format($model->oplata, 0, ',', ' ').'р.' ?></div>
        </div>
    </div>
    <div class="col-lg-12 footerView"></div>
    <div class="col-lg-12 footer-view-zakaz">
        <?php if (($model->status == Zakaz::STATUS_MASTER or $model->status == Zakaz::STATUS_DECLINED_MASTER) && Yii::$app->user->can('master')): ?>
            <?= Html::a('Готово', ['check', 'id' => $model->id_zakaz], ['class' => 'btn btn- done']) ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('seeAdop')): ?>
            <?php if ($model->status == Zakaz::STATUS_EXECUTE && $model->action == 1): ?>
                <?= Html::a('Готово', ['close', 'id' => $model->id_zakaz], ['class' => 'btn btn-xs done']) ?>
            <?php endif ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('admin')): ?>
            <?php if($model->status == Zakaz::STATUS_ADOPTED && $model->action == 1): ?>
                <?= Html::a('Выполнить', ['fulfilled','id' => $model->id_zakaz], ['class' => 'btn btn-xs done']) ?>
            <?php endif ?>
            <?php if ($model->status == Zakaz::STATUS_AUTSORS && $model->action == 1): ?>
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
            <?= Html::a('Задача', ['todoist/createzakaz', 'id_zakaz' => $model->id_zakaz], ['class' => 'btn btn-xs todoist']) ?>
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
        <?php if (($model->status == Zakaz::STATUS_DISAIN or $model->status == Zakaz::STATUS_DECLINED_DISAIN) && Yii::$app->user->can('disain')): ?>
            <?= Html::submitButton('Заказ исполнен', ['class' => 'action modalDisain', 'value' => Url::to(['uploadedisain', 'id' => $model->id_zakaz])]) ?>
        <?php endif ?>
        <?php if (!Yii::$app->user->can('seeIspol')): ?>
            <?= Html::a('Редактировать', ['zakaz/update', 'id' => $model->id_zakaz], ['class' => 'btn btn-xs', 'style' => 'float: right;margin-right: 10px;'])?>
        <?php endif ?>
<!--            --><?//= Html::a('Чек', ['#'], ['class' => 'btn btn-xs', 'style' => 'float: right;margin-right: 71px;'])?>
    </div>
