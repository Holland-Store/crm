<?php
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodoistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Персонал';
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => ['class' => 'table table-bordered'],
    'showHeader' => true,
    'striped' => false,
    'columns' => [
        [
            'attribute' => 'positions',
            'filter' => \app\models\Position::find()->select(['name', 'id'])->indexBy('id')->column(),
            'value' => 'positionsAsString',
        ],
        [
            'attribute' => 'nameSotrud',
        ],
        [
            'attribute' => 'phone',
        ],
        [
            'attribute' => 'shedule',
            'value' => function($model){
                return $model->shedule != null ? $model->shedule : false;
            },
        ],
        [
            'attribute' => 'job_duties',
            'value' => function($model){
                return $model->job_duties != null ? $model->job_duties : false;
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Действие',
            'template' => '{view} {update}',
        ]
    ],
]) ?>
