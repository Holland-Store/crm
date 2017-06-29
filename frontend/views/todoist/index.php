<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodoistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Все задачи';
?>
<div class="todoist-index">

    <p>
        <?php if (Yii::$app->user->can('admin')): ?>
            <?= Html::a('Создать задачу', ['create'], ['class' => 'btn btn-success']) ?>
        <?php endif ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'floatHeader' => true,
        'headerRowOptions' => ['class' => 'headerTable'],
        'pjax' => true,
        'tableOptions' 	=> ['class' => 'table table-bordered tableSize'],
        'rowOptions' => ['class' => 'trTable trNormal'],
        'striped' => false,
        'columns' => [
            [
                'attribute' => 'srok',
                'format' => ['date', 'php:d M'],
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'border-left textTr tr90', 'style' => 'border:none'],
            ],
            [
                'attribute' => 'comment',
                'contentOptions'=>['style'=>'white-space: normal;'],
            ],
            [
                'attribute' => 'zakaz',
                'format' => 'raw',
                'value' => function($model){
                    if ($model->id_zakaz != null) {
                        return Html::a($model->idZakaz->prefics, ['zakaz/view', 'id' => $model->id_zakaz]);
                    } 
                    return '';
                },
                'label' => 'Заказ',
                'hAlign' => GridView::ALIGN_RIGHT,
                'contentOptions' => ['class' => 'textTr tr50'],
            ],
            [
                'attribute' => 'id_user',
                'value' => function($model){
                    return $model->idUser->name;
                },
                'contentOptions' => ['class' => 'border-right textTr'],
            ],
        ],
    ]); ?>
</div>
<div class="footer-todoist">
    <?php echo Nav::widget([
        'options' => ['class' => 'nav nav-pills footerNav'],
        'items' => [
            ['label' => 'Архив', 'url' => ['closetodoist'], 'visible' => Yii::$app->user->can('seeAdmin')],
        ],
    ]); ?>
</div>
