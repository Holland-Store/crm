<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Otdel;
use app\models\Zakaz;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Nav;
use yii\widgets\MaskedInput;
use yii\grid\SetColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sidebar">
        <ui class="nav nav-pills">
            <li>
                <a href="index.php?r=zakaz%2Findex" >
                    <span>Заказ</span>
                </a>
            </li>
            <li>
                <a href="index.php?r=client%2Findex">
                    <span>Клиент</span>
                </a>
            </li>
            <?php if (!Yii::$app->user->isGuest && Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())['admin']->name == 'admin') { ?>
            <li>
                <a href="index.php?r=tovar%2Findex">
                    <span>Товар</span>
                </a>
            </li>
            <?php } ?>
        </ui>
</div>
<div class="zakaz-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <button data-toggle="modal" data-target="#myModal">Фильтр</button>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
          </div>
        </div>
      </div>
    </div>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id_zakaz',
                'headerOptions' => ['width' => '20']
            ],
            [
                'attribute' => 'status',
                'class' => SetColumn::className(),
                'format' => 'raw',
                'value' => 'statusName',
                'cssCLasses' => [
                    Zakaz::STATUS_NEW => 'Новый',
                    Zakaz::STATUS_WORK => 'В работе',
                    Zakaz::STATUS_EXECUTE => 'Исполнен',
                    Zakaz::STATUS_APOTED => 'Принят',
                    Zakaz::STATUS_DISAIN => 'Дизайнер',
                    Zakaz::STATUS_REJECT_DISAIN => 'Отклонен дизайнером',
                    Zakaz::STATUS_MASTER => 'Мастер',
                    Zakaz::STATUS_AUTSORS => 'Аутсорс',
                ],

                // function ($model, $key, $index, $column){
                //     $value = $model->{$column->attribute};
                //     switch ($value) {
                //         case Zakaz::STATUS_NEW:
                //             $class = 'primary';
                //             break;
                //         case Zakaz::STATUS_WORK:
                //             $class = 'default';
                //             break;
                //         case Zakaz::STATUS_EXECUTE:
                //             $class = 'success';
                //             break;
                //         case Zakaz::STATUS_APOTED:
                //             $class = 'warning';
                //             break;
                //         case Zakaz::STATUS_DISAIN:
                //             $class = 'info';
                //             break;
                //         case Zakaz::STATUS_REJECT_DISAIN:
                //             $class = 'danger';
                //             break;
                //         case Zakaz::STATUS_MASTER:
                //             $class = 'info';
                //             break;
                //         case Zakaz::STATUS_AUTSORS:
                //             $class = 'link';
                //             break;
                //     };
                //     $html = Html::tag('span', Html::encode($model->getStatusName()), ['class' => 'label label-'.$class]);
                //     return $value === null ? $column->grid->emptyCell : $html;
                // },
                'headerOptions' => ['width' => '50'],
            ],
            [
            'attribute' => 'description',
            'headerOptions' => ['width' => '550'],
            ],
             [
                'attribute' => 'id_tovar',
                'value' => 'idTovar.name',
                'filter' => Zakaz::getTovarList(),
                'headerOptions' => ['width' => '100'],
            ],
             [
                'attribute' => 'srok',
                'format' => ['datetime', 'php:d.m.Y'],
                'value' => 'srok',
                'filter' => DatePicker::widget([
                     'model' => $searchModel,
                     'attribute' => 'srok',
                    // inline too, not bad
                     'inline' => false, 
                     // modify template for custom rendering
                    // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                    'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy.mm.dd'
                ],
                ]),
                'headerOptions' => ['width' => '70'],
            ],
            [
                'attribute' => 'minut',
                'format' => ['time', 'php:H:i'],
                'headerOptions' => ['width' => '10'],
            ],
            // [
            //     'attribute' => 'id_sotrud',
            //     'value' => 'idSotrud.fio',
            //     'filter' => Zakaz::getSotrudList(),
            // ],
            // 'prioritet',
            [
                'attribute' => 'fact_oplata',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'oplata',
                'headerOptions' => ['width' => '50'],
            ],
            // 'number',
            // 'information',
            // 'img',
            // [
            //     'attribute' => 'name',
            // ],
            // [
            //     'attribute' => 'phone',
            // ],
            // 'comment:ntext',

            [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url,$model) {
                    return Html::a(
                    '<button class = "btn btn-primary">Открыть</button>', 
                    $url);
                },
            ],
            ],
        ],
    ]); ?>
</div>
