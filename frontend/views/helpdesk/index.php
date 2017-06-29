<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Nav;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HelpdeskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поломки';
?>
<?php Pjax::begin(); ?>
<div class="helpdesk-index">

    <p>
       	<?php if(!(Yii::$app->user->can('system'))):?>
		<?= Html::a('Вызвать мастера', ['create'], ['class' => 'btn btn-success']) ?>
       	<?php endif; ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
        'striped' => false,
        'rowOptions' => ['class' => 'trTable srok trNormal'],
        'columns' => [
            [
                'attribute' => 'id',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-left textTr tr50', 'style' => 'border:none'],
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'php:d M H:i'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr90'],
            ],
            [
				'attribute' => 'commetnt',
				'format' => 'text',
				'contentOptions'=>['style'=>'white-space: normal;'],
			],
            [
                'attribute' => 'id_user',
                'value' => 'idUser.name',
                'contentOptions' => ['class' => 'textTr tr90'],
                'hAlign' => GridView::ALIGN_RIGHT,
            ],
            [
                'attribute' => 'sotrud',
                'contentOptions' => function($model){
                    if (Yii::$app->user->can('system')){
                        return ['class' => 'textTr tr50'];
                    }  else {
                        return ['class' => 'border-right textTr', 'style'=>'white-space: normal;'];
                    }
                }
            ],
			[
                'attribute' => '',
                'format' => 'raw',
                'contentOptions' => ['class' => 'border-right textTr'],
                'value' => function($model) {
					if($model->status == 0){
						return Html::a('Решена', ['helpdesk/close', 'id' => $model->id]);
					} else {
						return '';
					}
                },
				'visible' => Yii::$app->user->can('system')
            ],
        ],
    ]); ?>
</div>
<?php Pjax::end(); ?>

