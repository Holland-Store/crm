<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Nav;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HelpdeskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Help Desk';
?>
<?php Pjax::begin(); ?>
<div class="helpdesk-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
       	<?php if(!(Yii::$app->user->can('system') or Yii::$app->user->can('shop'))):?>
		<?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
       	<?php endif; ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
				'attribute' => 'id_user',
				'value' => 'idUser.name',
			],
            [
				'attribute' => 'commetnt',
				'format' => 'text',
				'contentOptions'=>['style'=>'white-space: normal;'],
			],
//            'status',
            [
				'attribute' => 'date',
				'format' => ['date', 'd.MM.Y H:i']
			],
            'sotrud',
			[
                'attribute' => '',
                'format' => 'raw',
                'value' => function($model) {
					if($model->status == 0){
						return Html::a('Решена', ['helpdesk/close', 'id' => $model->id]);
					} else {
						return '';
					}
                },
				'visible' => Yii::$app->user->can('system')
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<?php Pjax::end(); ?>
