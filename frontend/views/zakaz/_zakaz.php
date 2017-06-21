<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\models\Courier;
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
        <div class="comment-zakaz">
            <?= 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores delectus dolor doloremque eos eum ex hic ipsam iste nobis obcaecati odio possimus quas quasi qui quis quo rem sapiente sequi sit sunt tenetur, ut vel voluptas. Autem cumque dolore dolorem dolores enim esse ex exercitationem hic iusto, laborum minima mollitia numquam odit pariatur, rem veritatis, voluptatum. Accusantium aliquid earum hic illum laboriosam libero, nesciunt provident quisquam repellendus vel. Accusamus architecto atque cum doloremque earum eius, eos, excepturi iusto magni maxime obcaecati quo repudiandae saepe similique voluptate voluptatem voluptatum! Alias assumenda autem dolores est facilis inventore laudantium libero maxime, neque perspiciatis, placeat porro qui quod! Beatae corporis earum enim eos, excepturi expedita laudantium maxime nam nobis obcaecati quisquam sunt suscipit tenetur, ut veritatis? Ad commodi consectetur cum cumque obcaecati rerum sint! Delectus distinctio dolorum magnam nobis quaerat recusandae ullam. Alias deleniti deserunt dolores ea eum excepturi id impedit in ipsum iure libero maxime nemo nesciunt nostrum odit officiis omnis pariatur perspiciatis quibusdam, ratione sed temporibus vero! Adipisci amet, consectetur culpa distinctio ducimus, error explicabo ipsum, iure magni molestiae molestias reiciendis similique sint totam veritatis? Amet beatae dolorum, inventore ipsa magni maiores praesentium vitae? Ab at aut beatae dicta doloremque doloribus ea eaque eligendi, esse excepturi expedita facere fugiat maiores minus modi molestiae neque nisi, nulla odit perferendis placeat porro provident quas quasi quia, quibusdam quod rem repellat repudiandae sapiente sequi similique soluta tempora tenetur vel vitae voluptas. Deleniti dicta doloremque ducimus exercitationem minus temporibus ut! Ab facere fugiat libero minima nemo optio veritatis. Accusantium ad at atque autem culpa deserunt distinctio dolor doloribus eaque, eligendi error eum explicabo id in mollitia nihil nisi officiis perferendis placeat qui quos rem repellat reprehenderit sit tempore tenetur veniam. A accusantium aliquid aperiam asperiores consequuntur corporis cupiditate debitis distinctio eius eos esse harum ipsam iste iusto libero magni maxime molestiae necessitatibus nihil nobis nulla praesentium quaerat quia, quis ratione repellat reprehenderit rerum soluta tempora tempore tenetur unde velit voluptas. Aperiam, ea error hic incidunt ipsa ipsam iure iusto laboriosam magni minima odio pariatur quibusdam quod repellendus, repudiandae similique sint, sit vitae voluptate voluptatibus? Consequuntur, dolore id maxime minima ullam veniam voluptatum! Atque autem blanditiis, consequatur ex harum id ipsum provident quo reprehenderit soluta? Aliquam aliquid autem cum dicta doloremque illo iste, maiores nesciunt non placeat possimus praesentium quam quisquam rem repellat, repellendus saepe sapiente. Culpa eveniet id ipsum labore maxime, molestiae nemo, perspiciatis possimus quia quibusdam quo sequi suscipit. Ab blanditiis dolores enim eum eveniet inventore ipsum laudantium nemo nobis nostrum quaerat, quo saepe sit. A accusamus ad adipisci architecto asperiores aut autem dolore dolorem eligendi explicabo fugit in iste iure labore libero minus molestiae natus nostrum odit provident qui quidem ratione repellendus similique veniam, voluptas voluptates voluptatibus. Cupiditate dolorum eaque error est laudantium minus mollitia officiis quibusdam. Deleniti deserunt dignissimos modi neque nesciunt porro possimus quas sunt totam voluptas? Adipisci aliquam animi aperiam asperiores blanditiis consectetur consequuntur explicabo laborum maiores modi mollitia necessitatibus nisi, numquam odit praesentium quidem soluta suscipit ullam unde vero voluptas.'?>
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
