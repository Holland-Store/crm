<?php

<<<<<<< HEAD
use yii\bootstrap\ButtonDropdown;
use yii\helpers\Html;
use kartik\grid\GridView;
=======
use yii\helpers\Html;
use yii\grid\GridView;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
use yii\widgets\Pjax;
use yii\bootstrap\Nav;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HelpdeskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Все поломки';
=======
$this->title = 'Help Desk';
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
?>
<?php Pjax::begin(); ?>
<div class="helpdesk-index">

<<<<<<< HEAD
    <p>
        <?php if (Yii::$app->user->can('disain')): ?>
        <?= Html::a('+', ['create'], ['class' => 'buttonAdd btn-group'])?>
        <?php endif ?>
       	<?php if(!(Yii::$app->user->can('system'))):?>
            <?php if (!Yii::$app->user->can('disain')): ?>
            <?php echo ButtonDropdown::widget([
                'label' => '+',
                'options' => [
                    'class' => 'btn buttonAdd',
                ],
                'dropdown' => [
                    'items' => [
                        [
                            'label' => 'Заказ',
                            'url' => ['zakaz/create'],
                            'visible' => Yii::$app->user->can('seeAdop'),
                        ],
                        [
                            'label' => '',
                            'options' => [
                                'role' => 'presentation',
                                'class' => 'divider'
                            ]
                        ],
                        [
                            'label' => 'Закупки',
                            'url' => ['custom/create'],
                            'visible' => !Yii::$app->user->can('disain'),
                        ],
                        [
                            'label' => '',
                            'options' => [
                                'role' => 'presentation',
                                'class' => 'divider'
                            ]
                        ],
                        [
                            'label' => 'Поломки',
                            'url' => ['helpdesk/create']
                        ],
                        [
                            'label' => '',
                            'options' => [
                                'role' => 'presentation',
                                'class' => 'divider'
                            ]
                        ],
                        [
                            'label' => 'Задачи',
                            'url' => ['todoist/create'],
                            'visible' => Yii::$app->user->can('admin'),
                        ],
                    ]
                ]
            ]); ?>
            <?php endif ?>
=======
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
       	<?php if(!(Yii::$app->user->can('system') or Yii::$app->user->can('shop'))):?>
		<?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
       	<?php endif; ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
<<<<<<< HEAD
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
=======
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
				'attribute' => 'id_user',
				'value' => 'idUser.name',
			],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
            [
				'attribute' => 'commetnt',
				'format' => 'text',
				'contentOptions'=>['style'=>'white-space: normal;'],
			],
<<<<<<< HEAD
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
=======
//            'status',
            [
				'attribute' => 'date',
				'format' => ['date', 'd.MM.Y H:i']
			],
            'sotrud',
			[
                'attribute' => '',
                'format' => 'raw',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
                'value' => function($model) {
					if($model->status == 0){
						return Html::a('Решена', ['helpdesk/close', 'id' => $model->id]);
					} else {
						return '';
					}
                },
				'visible' => Yii::$app->user->can('system')
            ],
<<<<<<< HEAD
=======

//            ['class' => 'yii\grid\ActionColumn'],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?>
</div>
<?php Pjax::end(); ?>
<<<<<<< HEAD

=======
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
