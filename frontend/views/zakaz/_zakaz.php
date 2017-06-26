<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Courier;
use yii\bootstrap\ActiveForm;
use app\models\Comment;
use app\models\Zakaz;
?>

<?php //$this->registerJs('$("body").on("click", "#edit", function(){
//           var key = $(this).data("key");
//        $.ajax({
//            url: "'.Url::toRoute(['zakaz/zakazedit']).'?id="+key,
//            timeout: 10000,
//            success: function(html){
//                $(".view-zakaz").html(html);
//            }
//        })
//    });') ?>

<div class="view-zakaz" style="color: black">
	<div class="col-lg-2 anketaZakaz">
        <span class="anketaZakaz_from">От:</span>
        <div><?= date('d M H:i',strtotime($model->data)) ?></div>

        <span class="anketaZakaz_from">Автор:</span>
        <div><?= $model->idSotrud->name ?></div>

        <span class="anketaZakaz_from">Клиент:</span>
        <div><?= $model->name ?></div>
        <div>8<?= $model->phone ?></div>
        <div><?= $model->email ?></div>
	    </div>
    </div>
	<div class="col-lg-7 zakazInfo">
        <div class="divInform">
        <?= 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic quia quaerat, id velit sit, perspiciatis repudiandae repellendus, distinctio ut, qui illo veniam! Quisquam blanditiis nostrum commodi esse inventore est eaque quidem rerum neque expedita ipsum itaque delectus saepe quia voluptatibus, aspernatur necessitatibus placeat rem minima facilis, dolores odio. Officiis voluptas, minima error iusto magnam omnis nostrum esse autem, sapiente sed repudiandae, natus quibusdam? Nisi fugit ex itaque animi cumque distinctio veritatis tempora possimus cupiditate culpa quam incidunt molestiae, minus laborum dolorum quidem aliquam vel. Quae nisi eveniet nam a consequuntur quaerat veniam sit rerum pariatur. Praesentium laborum sunt dolor, non. Enim error praesentium hic, mollitia deserunt id a iure at, in delectus, aspernatur nisi sint maiores illo animi ratione maxime porro impedit accusantium. Perspiciatis consequatur cum distinctio esse eaque repellat velit qui neque nam sed id non explicabo accusamus cupiditate eveniet, sunt officiis temporibus officia nesciunt porro. Earum aut deleniti adipisci vero explicabo sit et eum ad iste animi distinctio soluta, ipsam blanditiis veniam illum temporibus sint, commodi, laborum itaque cum ullam nihil reprehenderit laudantium consequatur debitis! Dolorem, debitis, quaerat. Eligendi eum officiis excepturi cupiditate dolorum, provident perferendis sint voluptatem natus aliquam fugit tempora earum alias atque iste impedit. Laudantium quas tempora quae vero eaque necessitatibus nam sint doloremque dolorum voluptas cupiditate soluta perferendis quibusdam animi, minus magnam minima ullam. Pariatur incidunt totam sed tenetur explicabo, recusandae quidem, placeat blanditiis at repellendus ipsum minima quia et, dolor animi aperiam tempore voluptates provident fuga qui. Nostrum perspiciatis vitae maiores consequuntur iure sed est repellat natus minima placeat saepe, amet eius blanditiis, facilis doloribus a cum cumque aspernatur porro ex nobis corrupti accusamus sint possimus beatae. Delectus nemo incidunt, laboriosam, nostrum voluptatum aperiam perspiciatis voluptatem libero quidem sunt autem! Deserunt vitae, molestias soluta delectus voluptatibus atque magni consequatur est sunt! Eveniet quia dolores quas provident, sit eligendi totam incidunt nesciunt accusantium fugiat asperiores id ad magni nobis reprehenderit explicabo earum consequatur error soluta repellat, ex! Explicabo officiis dolores voluptatem libero, cum quis similique doloremque reprehenderit tempora totam mollitia esse, aliquam quibusdam commodi quos. Cupiditate atque minima nulla illum velit. Quam similique in ea nisi quis modi vero libero repellendus iure sapiente enim amet impedit maxime fugiat ullam esse ad voluptate, culpa at illum provident aspernatur natus. Rerum minima in impedit quia voluptatum necessitatibus vero hic temporibus nam reiciendis. Illum, quae. Tenetur quod consequatur vitae natus veniam in iusto blanditiis perferendis cum quos ratione unde accusantium, assumenda nulla, velit voluptate magni fuga consectetur error hic sapiente animi! Perferendis atque recusandae, alias sequi quos voluptatem est provident, aliquid architecto. Repellat, cumque inventore incidunt, est saepe aut iure maiores amet minima debitis consequatur, voluptates accusantium enim reiciendis corporis veniam a eveniet. Blanditiis illum ducimus ipsa magnam quam sint ab fuga et, alias, architecto laborum itaque nostrum. Rem repellat voluptatem culpa distinctio provident iusto molestiae porro autem nostrum quibusdam aliquid veniam fuga blanditiis, quos quae asperiores ab dolor, quis in ad eum, ut voluptates numquam! Dolor aut quos, blanditiis accusantium molestias, tempora labore cupiditate quidem amet?'

        //$model->information ?>
        </div>
        <?php $comments = Comment::find()->where(['id_zakaz' => $model->id_zakaz])->all(); ?>
        <div class="comment-zakaz">
            <?php  foreach ($comments as $com){
                if ($com->id_user == Yii::$app->user->id){
                    $user = 'Я';
                } elseif ($com->id_user == 3){
                    $user = 'Дизайнер';
                } elseif ($com->id_user == 4){
                    $user = 'Мастер';
                } elseif ($com->id_user == 5){
                    $user = 'Админ';
                }
                echo  '
<div style="display: block;">
    <div style="width: 62px;float: left;text-align: right;padding-right: 10px;">'.$user.':</div>
    <div style="width: 446px;float: left;color: #505050">'.$com->comment.'</div>
    <div style="float: left;">'.date('d.m H:i', strtotime($com->date)).'</div>
</div>';
            }?>
        </div>
        <?= Html::buttonInput('Коммент', [
            'class' => 'btn btn-xs',
            'style' => '    padding-left: 13px;
                            padding-right: 13px;
                            float: right;
                            margin-top: -10px;
                            margin-right: 18px;
                            font-size: 11px;
                            background: #3a3331;
                            border-radius: 26px;
                            color: #736a50;']) ?>
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
			'template' => '<tr style="color:black;border: none;"><td{contentOptions} class="zakaz-view-kartik">{value}</td></tr></tr>',
			'attributes' => [
                [
                    'attribute' => 'maket',
                    'format' =>'raw',
                    'value' => $model->maket == null ? '<div style="margin-top: 44px"></div>' : Html::a('<span class="glyphicon glyphicon-saved imgZakaz" style="margin-top: 4px;margin-left: -33px;">', '@web/attachment/'.$model->img, ['download' => true, 'data-pjax' => 0, 'title' => 'Готовый макет от дизайнера'])
                ],
				[
				    'attribute' => 'img',
                    'format' =>'raw',
                    'value' => $model->img == null ? '<div></div>' : Html::a('<span class="glyphicon glyphicon-paperclip imgZakaz" style="margin-top: -10px;margin-left: -33px;"></span>', '@web/attachment/'.$model->img, ['download' => true, 'data-pjax' => 0, 'title' => 'Исходный файл от клиента'])
				],
			],
		]) ?>
	</div>
    <div class="responsible">
        <span class="responsible_person">Статус:</span>
        <div>
            <?php if ($model->status == Zakaz::STATUS_SUC_DISAIN){
                echo '<div class="statusZakaz">Выполнено</div>
<div>'
                    .Html::a('<div class="action actionApprove" style="width:70px;position: relative;left: 62px;top: -1px;">Принять</div>', ['#']).' '
                    .Html::a('<div class="action actionCancel" style="left:143px;top:-21px;width:79px;position: relative;">Отклонить</div>', ['#']).'
</div>';
            }
            elseif($model->status == Zakaz::STATUS_DECLINED_DISAIN){
                echo '<div class="statusZakaz" style="background: #7c1111">Отклонено</div>
<div style="width: 155px;position: relative;left: 63px;top: -1px;"">
<span class="responsible_person">По причине:</span><br> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, vero.</div>';
            }
            ?>
        </div>
        <div class="oplata-zakaz">
            <span class="responsible_person">Всего:</span>
            <span class="responsible_person">Оплачено:</span>
            <span class="responsible_person">К доплате:</span><br>
            <?= $model->oplata.'р.' ?>
            <?= $model->fact_oplata.'р.' ?>
            <?php if($model->oplata != null){?>
                <?php echo $model->oplata - $model->fact_oplata.'р.'; ?>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-12 footerView"></div>
    <div class="col-lg-12 footer-view-zakaz">
        <?= Html::a('Задача', ['todoist/createzakaz', 'id_zakaz' => $model->id_zakaz], ['class' => 'btn btn-xs', 'style' => 'margin-left: 97px;']) ?>
        <?= Html::a('Запрос', ['todoist/create_shop'], ['class' => 'btn btn-xs']) ?>
        <?php Modal::begin([
            'header' => '<h2>Создание доставки</h2>',
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
        <?= Html::a('Редактировать', ['zakaz/update', 'id' => $model->id_zakaz], ['class' => 'btn btn-xs', 'style' => 'float: right;margin-right: 10px;'])?>
    </div>
</div>
