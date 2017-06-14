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
		<?= Detailview::widget([
			'model' => $model,
			'options' => ['class' => 'table detail-view'],
			'template' => '<tr style="color:black;border: none;"><td{contentOptions} class="zakaz-view-kartik">{value}</td></tr></tr>',
			'attributes' => [
				[
					'attribute' => 'information',
					'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eum dolore ex dignissimos hic unde facilis saepe veniam nulla blanditiis minus aperiam, soluta aspernatur, praesentium, possimus voluptate cum minima nisi corporis numquam sint sit. Quod harum architecto saepe iste maxime sequi nesciunt rem, libero soluta voluptas provident quas. Officiis provident rerum, doloremque vel accusantium dolores deleniti quod sequi itaque ex rem mollitia, molestias eum. Illum sequi ea quod earum delectus, dolor dolore quae nulla totam consequuntur, esse quibusdam. Repudiandae, nobis magnam similique quia ea aperiam tenetur dolorem minima? Similique officiis voluptatibus nesciunt veniam ab distinctio doloribus. Quo facere, aliquam unde officiis adipisci illo dolorem repudiandae fuga architecto nesciunt. Quae obcaecati, sapiente officia repellendus, iure numquam recusandae quam rem quis odit consequatur eaque nihil delectus iste, aliquid repudiandae amet culpa ut. Soluta inventore laborum aut, officia aliquam, non amet voluptatem quos, ab quasi illum? Sit provident fugit beatae suscipit sapiente quam doloremque, ipsam illum cum debitis corporis laboriosam adipisci ex perferendis dignissimos, reiciendis cupiditate id sed, voluptatibus harum velit temporibus sint delectus. Quibusdam unde nostrum inventore aut aliquid? Doloremque labore officiis sapiente quam atque quos totam assumenda laborum officia, accusamus, natus quibusdam id quaerat soluta animi porro dolores ea. Laborum odio ratione reiciendis, ducimus ex porro, quaerat iure ut distinctio tenetur libero eaque blanditiis odit nobis ipsum? Reiciendis quod dolorum excepturi aut ex id placeat ullam assumenda necessitatibus distinctio nihil ab totam nobis laboriosam vero laborum, earum qui. Deserunt odio fugit porro accusantium dicta sapiente, impedit iusto nesciunt, cumque consequatur ab vero reiciendis! Ab unde, voluptas soluta rem in quam alias, illum magnam neque tenetur ducimus exercitationem, a temporibus incidunt earum iste molestias dolores! Voluptatum nemo quis id eius, alias nisi blanditiis nulla, voluptatem, corrupti libero ipsum? Ullam ut rerum, adipisci quasi repellat porro, accusantium voluptas provident eum dolores quidem placeat excepturi inventore esse recusandae hic enim obcaecati voluptate, unde at voluptatem. Natus ab nulla totam culpa nam voluptatibus officiis, numquam optio similique alias officia eveniet. Dolorum illo accusamus consectetur vero possimus eveniet vel a maiores, odit, quod expedita rerum, consequatur laborum. Atque maxime quisquam optio est asperiores quis, accusantium deleniti, delectus aliquid sapiente ipsam libero repellendus repudiandae et pariatur blanditiis consequuntur distinctio, eaque facilis. Rem temporibus ad doloribus a velit saepe quaerat maxime cupiditate nemo adipisci enim vel ex officiis non, labore dolorem tempore quibusdam, aperiam odit voluptatibus architecto nihil illum numquam natus, corporis. Reiciendis impedit praesentium ipsa, dolore voluptates dolorum iste, quos sapiente asperiores voluptas quam ad quod rem incidunt aliquam non, optio vitae quibusdam. Numquam error, blanditiis eius rem commodi voluptatibus quas, atque eligendi exercitationem amet, officia repellat incidunt in hic harum. Odit quidem esse ratione et cupiditate error in nulla itaque repudiandae consequatur qui magnam enim exercitationem temporibus placeat saepe, ex, perferendis, eveniet facere nostrum ut nisi. Numquam nostrum nihil quo soluta voluptates neque consequatur deleniti necessitatibus consectetur nobis cum ad accusantium dolorum quae placeat voluptate asperiores iusto aut perspiciatis delectus, amet, dolorem et esse libero. Aperiam perferendis nesciunt necessitatibus accusamus ea, aliquid porro, error numquam rem sapiente!',
					'contentOptions' => ['class' => 'trInform']
				],
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
