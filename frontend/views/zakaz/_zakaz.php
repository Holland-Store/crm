<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Courier;
use yii\bootstrap\ActiveForm;
use app\models\Comment;
?>

<?php $this->registerJs('$("body").on("click", "#edit", function(){
           var key = $(this).data("key");
        $.ajax({
            url: "'.Url::toRoute(['zakaz/zakazedit']).'?id="+key,
            timeout: 10000,
            success: function(html){
                $(".view-zakaz").html(html);
            }
        })
    });') ?>

<div class="view-zakaz" style="color: black">
	<div class="col-lg-2">
		<?= Detailview::widget([
			'model' => $model,
			// 'striped' => false,
			'options' => ['class' => 'table detail-view'],
			'template' => '<tr style="color:black;border: none;"><td{contentOptions} class="zakaz-view-kartik">{value}</td></tr></tr>',
			'attributes' => [
				[
					'attribute' => 'data',
					'format' => ['date','d.MM.Y H:i'],
				],
				[
					'attribute' => 'id_sotrud',
					'value' => $model->idSotrud->name
				],
				'name',
				[
                    'attribute' => 'phone',
                    'value' => '8'.$model->phone,
				],
				'email',
			],
		]) ?>
	</div>
	<div class="col-lg-7">
        <div class="divInform">
        <?= $model->information ?>
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
                }
                echo  '<div style="display: block;height: 100%;"><div style="width: 62px;float: left;">'.$user.'</div> <div style="width: 438px;float: left;">'.$com->comment.'</div> <div style="float: left;">'.date('d.m H:i', strtotime($com->date)).'</div style="float: left;"></div>';
            }?>
        </div>
        <div>
            <?php $formComment = ActiveForm::begin([
                    'id' => 'formComment',
            ]); ?>
            <?php if ($model->status == 3){
                $comment->sotrud = 3;
                $sotrud = $comment->sotrud;
            } elseif($model->status == 4){
                $comment->sotrud = 4;
                $sotrud = $comment->sotrud;
            }
            ?>
            <div class="col-lg-11">
                <?= $formComment->field($comment, 'comment')->textarea(['placeholder' => 'Комментарий', 'rows' => 1])->label(false) ?>
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
		<?= Detailview::widget([
			'model' => $model,
			'options' => ['class' => 'table detail-view'],
			'template' => '<tr style="color:black;border: none;"><td{contentOptions} class="zakaz-view-kartik">{value}</td></tr></tr>',
			'attributes' => [
				'number',
				'id_tovar',
			],
		]) ?>
	</div>
	<div class="col-lg-3">
		<?= Detailview::widget([
			'model' => $model,
			'options' => ['class' => 'table detail-view'],
			'template' => '<tr style="color:black;border: none;"><td{contentOptions} class="zakaz-view-kartik">{value}</td></tr></tr>',
			'attributes' => [
				'statusName',
				[
					'attribute' => 'id_shipping',
					'value' => $model->idShipping->dostavkaName,
				],
				'img',
				'maket',
			],
		]) ?>
	</div>
    <div class="footer-view-zakaz">
        <?= Html::a('Задача', ['todoist/createzakaz', 'id_zakaz' => $model->id_zakaz]) ?>
        <?= Html::a('Запрос', ['todoist/create_shop']) ?>
        <?php Modal::begin([
            'header' => '<h2>Создание доставки</h2>',
            'toggleButton' => [
                'tag' => 'a',
                'label' => 'Доставка',
            ]
        ]);
        $shipping = new Courier();
        echo $this->render('shipping', [
           'shipping' => $shipping,
            'model' => $model->id_zakaz,
        ]);

        Modal::end(); ?>
        <?= Html::submitButton('Редактировать', ['id' => 'edit', 'data-key' => $model->id_zakaz]) ?>
    </div>
</div>
