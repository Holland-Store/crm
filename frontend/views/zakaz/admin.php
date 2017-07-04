<?php

<<<<<<< HEAD
use app\models\Courier;
use yii\bootstrap\Nav;
use yii\helpers\StringHelper;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use app\models\Zakaz;
use app\models\Comment;
use yii\bootstrap\ButtonDropdown;
use yii\grid\SetColumn;
use yii\helpers\Url;
use yii\widgets\Pjax;


=======
use yii\helpers\Html;
use kartik\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\Modal;
use yii\widgets\MaskedInput;
use yii\grid\SetColumn;
use yii\widgets\Pjax;

>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

<<<<<<< HEAD
$this->title = 'Вce заказы';
?>
<?php Pjax::begin(['id' => 'pjax-container']); ?>

<div class="zakaz-index">
    <p>
        <?php echo ButtonDropdown::widget([
        'label' => '+',
        'options' => [
            'class' => 'btn buttonAdd',
        ],
        'dropdown' => [
            'items' => [
                [
                    'label' => 'Заказ',
                    'url' => 'zakaz/create',
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
                    'url' => 'custom/create'
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
                    'url' => 'helpdesk/create'
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
                    'url' => 'todoist/create'
                ],
            ]
        ]
    ]); ?>
        <?php //echo $this->render('_search', ['model' => $searchModel]);?>
    </p>
    <div class="col-lg-12 divWork">
            <h3 class="titleTable">В работе</h3>
            <div class="col-lg-2 zakazSearch">
                <?php echo $this->render('_searchadmin', ['model' => $searchModel]);?>
            </div>
    </div>
    <div class="col-lg-12">
        <?=
        GridView::widget([
        'dataProvider' => $dataProviderWork,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
        'rowOptions' => function($model, $key, $index, $grid){
            if ($model->srok < date('Y-m-d H:i:s') && $model->status > Zakaz::STATUS_NEW ) {
                return ['class' => 'trTable trTablePass italic trSrok'];
            } elseif ($model->srok < date('Y-m-d H:i:s') && $model->status == Zakaz::STATUS_NEW) {
                return['class' => 'trTable trTablePass bold trSrok trNew'];
            } elseif ($model->srok > date('Y-m-d H:i:s') && $model->status == Zakaz::STATUS_NEW){
                return['class' => 'trTable bold trSrok trNew'];
            } else {
                return ['class' => 'trTable trNormal'];
            }
        },
		'striped' => false,
        'columns' => [
			[
				'class'=>'kartik\grid\ExpandRowColumn',
                'contentOptions' => function($model){
                    return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
                },                
				'width'=>'10px',
=======
$this->title = 'Заказ';
?>
<?php Pjax::begin(['id' => 'pjax-container']); ?>
 
<div class="zakaz-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
        <?php //echo $this->render('_search', ['model' => $searchModel]);?>
        <?= Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['zakaz/admin'], ['class' => 'btn btn-primary btn-lg pull-right']) ?>
    </p>

    <?php echo $this->render('_searchadmin', ['model' => $searchModel]);?>
    <div class="col-xs-12">
    <h3>Новые</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProviderNew,
        'tableOptions' => ['class' => 'table table-bordered'],
        'rowOptions' => function($model, $key, $index, $grid){
            return['id' => 'trNew'];
        },
        'columns' => [
            [
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20'],
                'value' => 'prefics',
            ],
            [
                'attribute' => 'description',
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d.m.Y'],
                'value' => 'srok',
                'filter' => DatePicker::widget([
                     'model' => $searchModel,
                     'attribute' => 'srok',
                     'inline' => false, 
                    'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy.mm.dd'
                ],
                ]),
                'headerOptions' => ['width' => '70'],
            ],
            [
                'attribute' => 'minut',
                'headerOptions' => ['width' => '10'],
            ],
            [
                'attribute' => 'fact_oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'img',
                'format' => 'raw',
                
            ],
            [
                'attribute' => 'id_shipping',
                'value' => function($model){   
                    return $model->idShipping->dostavkaName;
                }
            ],
            [
                'attribute' => 'id_sotrud',
                'value' => 'idSotrud.name',
            ],
        ],
    ]); ?>  
    <h3 class="titleTable">В работе</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProviderWork,
        'floatHeader' => true,
        'headerRowOptions' => ['style' => 'font-size: 11px;'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered', 'style' => 'font-size:11px;'],
        'rowOptions' => function($model, $key, $index, $grid){
            if ($model->srok < date('Y-m-d')) {
                return['class' => 'trTable trTablePass'];
            } else {
                return['class' => 'trTable'];
            }
        },
		'striped' => false,
		'hover'=>true,
        'columns' => [
			[
				'class'=>'kartik\grid\ExpandRowColumn',
				'width'=>'1px',
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
				'value' => function ($model, $key, $index) {
					return GridView::ROW_COLLAPSED;
				},
				'detail'=>function ($model, $key, $index, $column) {
<<<<<<< HEAD
                    $comment = new Comment();
					return Yii::$app->controller->renderPartial('_zakaz', ['model'=> $model, 'comment' => $comment]);
=======
					return Yii::$app->controller->renderPartial('_zakaz', ['model'=>$model]);
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
				},
				'enableRowClick' => true,
                'expandOneOnly' => true,
                'expandIcon' => ' ',
                'collapseIcon' => ' ',
			],
            [
                'attribute' => 'id_zakaz',
<<<<<<< HEAD
                'value' => 'prefics',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => function($model) {
                    if ($model->status == Zakaz::STATUS_NEW){
                        return ['class' => 'trNew tr70'];
                    } else {
                        return ['class' => 'textTr tr70'];
                    }
                },
=======
                'headerOptions' => ['width' => '50'],
                'value' => 'prefics',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr'],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
            ],
            [
                'attribute' => '',
                'format' => 'raw',
<<<<<<< HEAD
                'contentOptions' => ['class' => 'tr20'],
=======
                'headerOptions' => ['width' => '20'],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
                'value' => function($model){
                    if ($model->prioritet == 2) {
                        return '<i class="fa fa-circle fa-red" aria-hidden="true"></i>';
                    } elseif ($model->prioritet == 1) {
                        return '<i class="fa fa-circle fa-ping" aria-hidden="true"></i>';
                    } else {
                        return '';
                    }

                }
            ],
            [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d M H:i'],
                'value' => 'srok',
<<<<<<< HEAD
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => function($model) {
                    if ($model->status == Zakaz::STATUS_NEW){
                        return ['class' => 'trNew tr90'];
                    } else {
                        return ['class' => 'textTr tr90'];
                    }
                },
            ],
            [
                'attribute' => 'minut',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => function($model) {
                    if ($model->status == Zakaz::STATUS_NEW){
                        return ['class' => 'trNew tr10'];
                    } else {
                        return ['class' => 'textTr tr10'];
                    }
                },
                'value' => function($model){
                    if ($model->minut == null){
                        return '';
                    } else {
                        return $model->minut;
                    }
                }
            ],
            [
                'attribute' => 'description',
                'value' => function($model){
                    return StringHelper::truncate($model->description, 100);
                }
            ],
            [
                'attribute' => 'id_shipping',
                'format' => 'raw',
                'contentOptions' => ['class' => 'tr50'],
                'value' => function($model){
                    if ($model->id_shipping == null or $model->id_shipping == null){
                        return '';
                    } else {
                        if ($model->idShipping->status == Courier::DOSTAVKA or $model->idShipping->status == Courier::RECEIVE) {
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #f0ad4e;" aria-hidden="true"></i>';
                        } elseif ($model->idShipping->status == Courier::DELIVERED){
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #191412;" aria-hidden="true"></i>';
                        } else {
                            return '';
                        }
                    }
                }
            ],
            [
                'attribute' => 'oplata',
=======
                'headerOptions' => ['width' => '90'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr'],
            ],
            [
                'attribute' => 'minut',
                'headerOptions' => ['width' => '10'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr'],
            ],
            [
                'attribute' => 'description',
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '70'],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
                'value' => function($model){
                    return $model->oplata.' р.';
                },
                'hAlign' => GridView::ALIGN_RIGHT,
<<<<<<< HEAD
                'contentOptions' => function($model) {
                    if ($model->status == Zakaz::STATUS_NEW){
                        return ['class' => 'trNew tr70'];
                    } else {
                        return ['class' => 'textTr tr70'];
                    }
                },
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function($model){
                    return '';
                },
                'contentOptions' => ['class' => 'textTr border-right tr90'],
            ]
//            [
//                'attribute' => 'statusName',
//                'label' => 'Отв-ный',
//                'contentOptions' => ['class' => 'border-right'],
//            ],
//            [
//                'attribute' => 'status',
//                'class' => SetColumn::className(),
//                'label' => 'Отв-ный',
//                'format' => 'raw',
//                'name' => 'statusName',
//                'cssCLasses' => [
//                    Zakaz::STATUS_NEW => 'primary',
//                    Zakaz::STATUS_EXECUTE => 'success',
//                    Zakaz::STATUS_ADOPTED => 'warning',
//                    Zakaz::STATUS_REJECT => 'danger',
//                    Zakaz::STATUS_SUC_DISAIN => 'success',
//                    Zakaz::STATUS_SUC_MASTER => 'success',
//                ],
//                'contentOptions' => ['class' => 'border-right'],
//            ],
        ],
    ]); ?>
    </div>
    <div class="col-lg-12">
        <h3 class="titleTable">На исполнении</h3>
    </div>
    <div class="col-lg-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions'  => ['class' => 'table table-bordered tableSize'],
        'striped' => false,
        'rowOptions' => function($model, $key, $index, $grid){
            if ($model->srok < date('Y-m-d H:i:s')) {
                return['class' => 'trTable trTablePass trNormal'];
            } else {
                return['class' => 'trTable srok trNormal'];
=======
                'contentOptions' => ['class' => 'textTr'],
            ],
            [
                'attribute' => 'status',
                'class' => SetColumn::className(),
                'label' => 'Отв-ный',
                'format' => 'raw',
                'name' => 'statusName',
                'cssCLasses' => [
                    Zakaz::STATUS_EXECUTE => 'success',
                    Zakaz::STATUS_ADOPTED => 'warning',
                    Zakaz::STATUS_REJECT => 'danger',
                    Zakaz::STATUS_SUC_DISAIN => 'success',
                    Zakaz::STATUS_SUC_MASTER => 'success',
                ],
                'headerOptions' => ['width' => '70'],
            ],
        ],
    ]); ?>
    <h3>На исполнении</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-bordered'],
        'rowOptions' => function($model, $key, $index, $grid){
            if ($model->srok < date('Y-m-d')) {
                return['class' => 'trTable trTablePass'];
            } else {
                return['class' => 'trTable'];
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
            }
        },
        'columns' => [
            [
<<<<<<< HEAD
                'class'=>'kartik\grid\ExpandRowColumn',
                'contentOptions' => function($model, $key, $index, $grid){
                    return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
                }, 
                'width'=>'10px',
                'value' => function ($model, $key, $index) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    $comment = new Comment();
                    return Yii::$app->controller->renderPartial('_zakaz', ['model'=>$model, 'comment' => $comment]);
                },
                'enableRowClick' => true,
                'expandOneOnly' => true,
                'expandIcon' => ' ',
                'collapseIcon' => ' ',
            ],
            [
                'attribute' => 'id_zakaz',
                'value' => 'prefics',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => function($model) {
                    if ($model->id_unread == true){
                        return ['class' => 'trNew tr70'];
                    } else {
                        return ['class' => 'textTr tr70'];
                    }
                },
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'contentOptions' => ['class' => 'tr20'],
                'value' => function($model){
                    if ($model->prioritet == 2) {
                        return '<i class="fa fa-circle fa-red" aria-hidden="true"></i>';
                    } elseif ($model->prioritet == 1) {
                        return '<i class="fa fa-circle fa-ping" aria-hidden="true"></i>';
                    } else {
                        return '';
                    }

                }
            ],
            [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d M H:i'],
                'value' => 'srok',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => function($model) {
                    if ($model->id_unread == true){
                        return ['class' => 'trNew tr90'];
                    } else {
                        return ['class' => 'textTr tr90'];
                    }
                },
            ],
            [
                'attribute' => 'minut',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => function($model) {
                    if ($model->id_unread == true){
                        return ['class' => 'trNew tr10'];
                    } else {
                        return ['class' => 'textTr tr10'];
                    }
                },
                'value' => function($model){
                    if ($model->minut == null){
                        return '';
                    } else {
                        return $model->minut;
                    }
                }
            ],
            [
                'attribute' => 'description',
                'value' => function($model){
                    return StringHelper::truncate($model->description, 100);
                },
                'contentOptions' => function($model) {
                    if ($model->id_unread == true){
                        return ['class' => 'trNew'];
                    } else {
                        return '';
                    }
                },
            ],
            [
                    'attribute' => 'id_shipping',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'tr50'],
                    'value' => function($model){
                        if ($model->id_shipping == null or $model->id_shipping == null){
                            return '';
                        } else {
                            if ($model->idShipping->status == Courier::DOSTAVKA or $model->idShipping->status == Courier::RECEIVE) {
                                return '<i class="fa fa-truck" style="font-size: 13px;color: #f0ad4e;" aria-hidden="true"></i>';
                            } elseif ($model->idShipping->status == Courier::DELIVERED){
                                return '<i class="fa fa-truck" style="font-size: 13px;color: #191412;" aria-hidden="true"></i>';
                            } else {
                                return '';
                            }
                        }
                    }
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '70'],
                'value' => function($model){
                    return $model->oplata.' р.';
                },
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => function($model) {
                    if ($model->id_unread == true){
                        return ['class' => 'trNew tr70'];
                    } else {
                        return ['class' => 'textTr tr70'];
                    }
                },
            ],
            [
                'attribute' => 'statusName',
                'label' => 'Отв-ный',
                'contentOptions' => function($model) {
                    if ($model->id_unread == true){
                        return ['class' => 'border-right trNew'];
                    } else{
                        return ['class' => 'border-right textTr'];
                    }
                },
            ],
        ],
    ]); ?>
    </div>
    <div class="col-lg-12">
        <h3 class="titleTable">На закрытие</h3>
    </div>
    <div class="col-lg-12">
        <?= /** @var TYPE_NAME $dataProviderIspol */
    GridView::widget([
        'dataProvider' => $dataProviderIspol,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'striped' => false,
        'tableOptions' => ['class' => 'table table-bordered tableSize'],
        'rowOptions' => ['class' => 'trTable srok trNormal'],
        'columns' => [
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'contentOptions' => function($model, $key, $index, $grid){
                    return ['id' => $model->id_zakaz, 'class' => 'border-left', 'style' => 'border:none'];
                }, 
                'width'=>'10px',
                'value' => function ($model, $key, $index) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    $comment = new Comment();
                    return Yii::$app->controller->renderPartial('_zakaz', ['model'=>$model, 'comment' => $comment]);
                },
                'enableRowClick' => true,
                'expandOneOnly' => true,
                'expandIcon' => ' ',
                'collapseIcon' => ' ',
            ],
            [
                'attribute' => 'id_zakaz',
                'value' => 'prefics',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr70'],
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'contentOptions' => ['class' => 'tr20'],
                'value' => function($model){
                    if ($model->prioritet == 2) {
                        return '<i class="fa fa-circle fa-red" aria-hidden="true"></i>';
                    } elseif ($model->prioritet == 1) {
                        return '<i class="fa fa-circle fa-ping" aria-hidden="true"></i>';
                    } else {
                        return '';
                    }

                }
            ],
            [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d M H:i'],
                'value' => 'srok',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr90'],
            ],
            [
                'attribute' => 'minut',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr10'],
                'value' => function($model){
                    if ($model->minut == null){
                        return '';
                    } else {
                        return $model->minut;
                    }
                }
            ],
            [
                'attribute' => 'description',
                'value' => function($model){
                    return StringHelper::truncate($model->description, 100);
                }
            ],
            [
                'attribute' => 'id_shipping',
                'format' => 'raw',
                'contentOptions' => ['class' => 'tr50'],
                'value' => function($model){
                    if ($model->id_shipping == null or $model->id_shipping == null){
                        return '';
                    } else {
                        if ($model->idShipping->status == Courier::DOSTAVKA or $model->idShipping->status == Courier::RECEIVE) {
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #f0ad4e;" aria-hidden="true"></i>';
                        } elseif ($model->idShipping->status == Courier::DELIVERED){
                            return '<i class="fa fa-truck" style="font-size: 13px;color: #191412;" aria-hidden="true"></i>';
                        } else {
                            return '';
                        }
                    }
                }
            ],
            [
                'attribute' => 'oplata',
                'value' => function($model){
                    return $model->oplata.' р.';
                },
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr70'],
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function($model){
                    return '';
                },
                'contentOptions' => ['class' => 'textTr border-right tr90'],
            ]
=======
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20'],
                'value' => 'prefics',
            ],
            [
                'attribute' => 'status',
                'class' => SetColumn::className(),
                'format' => 'raw',
                'name' => 'statusName',
                'cssCLasses' => [
                    Zakaz::STATUS_DISAIN => 'danger',
                    Zakaz::STATUS_SUC_DISAIN => 'success',
                    Zakaz::STATUS_MASTER => 'primary',
                    Zakaz::STATUS_SUC_MASTER => 'success',
                    Zakaz::STATUS_AUTSORS => 'info',
                ],
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'description',
                'format' => 'text',
                'options' => ['width' => '200'],
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            //  [
            //     'attribute' => 'id_tovar',
            //     'value' => 'idTovar.name',
            //     'filter' => Zakaz::getTovarList(),
            //     'headerOptions' => ['width' => '100'],
            // ],
             [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d.m.Y'],
                'value' => 'srok',
                'filter' => DatePicker::widget([
                     'model' => $searchModel,
                     'attribute' => 'srok',
                    // inline too, not bad
                     'inline' => false, 
                    'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy.mm.dd'
                ],
                ]),
                'headerOptions' => ['width' => '70'],
            ],
            [
                'attribute' => 'minut',
                'headerOptions' => ['width' => '10'],
            ],
            [
                'attribute' => 'fact_oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'img',
                'format' => 'raw',
            ],
            [
                'attribute' => 'id_shipping',
                'value' => function($model){   
                    return $model->idShipping->dostavkaName;
                }
            ],
            [
                'attribute' => 'id_sotrud',
                'value' => 'idSotrud.name',
            ],
        ],
    ]); ?>

    <h3>На закрытие</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProviderIspol,
        'tableOptions' => ['class' => 'table table-bordered'],
        'rowOptions' => ['class' => 'trTable'],
        'columns' => [

            [
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20'],
                'value' => 'prefics',
            ],
            [
                'attribute' => 'description',
                'headerOptions' => ['width' => '200'],
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            //  [
            //     'attribute' => 'id_tovar',
            //     'value' => 'idTovar.name',
            //     'filter' => Zakaz::getTovarList(),
            //     'headerOptions' => ['width' => '100'],
            // ],
             [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d.m.Y'],
                'value' => 'srok',
                'filter' => DatePicker::widget([
                     'model' => $searchModel,
                     'attribute' => 'srok',
                    // inline too, not bad
                     'inline' => false, 
                    'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy.mm.dd'
                ],
                ]),
                'headerOptions' => ['width' => '70'],
            ],
            [
                'attribute' => 'minut',
                'headerOptions' => ['width' => '10'],
            ],
            [
                'attribute' => 'fact_oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'img',
                'format' => 'raw',
                
            ],
            [
                'attribute' => 'id_shipping',
                'value' => function($model){   
                    return $model->idShipping->dostavkaName;
                }
            ],
            [
                'attribute' => 'id_sotrud',
                'value' => 'idSotrud.name',
            ],
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        ],
    ]); ?> 
    <?php Pjax::end(); ?>
    </div>
<<<<<<< HEAD
    <?php Modal::begin([
        'id' => 'declinedModal',
        'header' => '<h2>Укажите причину отказа:</h2>',
    ]);

    echo '<div class="modalContent"></div>';

    Modal::end();?>
    <?php Modal::begin([
        'id' => 'acceptdModal',
        'header' => '<h2>Назначить ответственного:</h2>',
    ]);

    echo '<div class="modalContent"></div>';

    Modal::end();?>
</div>
<div class="footer">
    <?php echo Nav::widget([
        'options' => ['class' => 'nav nav-pills footerNav'],
        'items' => [
            ['label' => 'Архив', 'url' => ['archive'], 'visible' => Yii::$app->user->can('seeAdmin')],
        ],
    ]); ?>
=======
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
</div>
