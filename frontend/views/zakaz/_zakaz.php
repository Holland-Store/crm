<?php

use app\models\Comment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Zakaz;

/* @var  $comment app\models\Comment */
/* @var  $model app\models\Zakaz */
/* @var  $client app\models\Client */
/** @var string $sotrud */
?>

<div class="view-zakaz" style="color: black">
	<div class="col-lg-2 anketaZakaz">
        <span class="anketaZakaz_from">От:</span>
        <div class="srok"><?= Yii::$app->formatter->asDatetime($model->data); ?>
        <span class="anketaZakaz_from">Автор:</span>
        <div><?= $model->idSotrud->name ?></div>

        <?php if ($model->shifts_id != null): ?>
        <span class="anketaZakaz_from">Сотрудник:</span>
        <div><?= $model->shifts->idSotrud->name ?></div>
        <?php endif; ?>

        <span class="anketaZakaz_from">Клиент:</span>
        <div><?php if ($model->name == null) {
                echo $model->idClient->name;
} else {
            echo $model->name;
            } ?></div>
        <div>
            <?php if ($model->phone == null){
                echo $model->idClient->phone;
            } else {
                echo $model->phone;
            }  ?>
        </div>
        <div><?= $model->idClient->email ?></div>
	    </div>
    </div>
	<div class="col-lg-7 zakazInfo">
        <div class="divInform">
        <?= $model->information ?>
        </div>
        <?php
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Comment::find()->where(['id_zakaz' => $model->id_zakaz])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 6,
            ]
        ]);
        ?>
        <div class="comment-zakaz">
            <?php
            echo \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => '_comment',
                'pager' => ['class' => \kop\y2sp\ScrollPager::className()]
            ]) ?>
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
            <?php if (Yii::$app->user->can('admin')): ?>
                <?= Html::a('Доставка', ['#'],['class' => 'btn action modalShipping-button', 'value' => Url::to(['courier/create-zakaz', 'id' => $model->id_zakaz]), 'onclick' => 'return false']) ?>
            <?php endif ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('seeAdop') && $model->renouncement == null): ?>
            <?php Modal::begin([
                'header' => '<h3 style="color: rgba(204, 198, 198, 0.6)">Укажите причину отказа</h3>',
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
                <?= Html::a('Чек', ['#'], ['class' => 'draft btn action', 'value' => Url::to(['financy/draft', 'id' => $model->id_zakaz])]) ?>
            <?php endif ?>
        <?php endif; ?>
        <?= Html::a('Полный просмотр', ['view', 'id' => $model->id_zakaz], ['class' => 'btn action']) ?>
    </div>