<?php
use kartik\grid\GridView;
use yii\helpers\Url;


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
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '1px',
            'enableRowClick' => true,
            'expandOneOnly' => true,
            'expandIcon' => '<span class="glyphicon glyphicon-chevron-right"></span>',
            'collapseIcon' => '<span class="glyphicon glyphicon-chevron-down"></span>',
            'detailUrl' => Url::to(['employee']),
            'value' => function(){
                return GridView::ROW_COLLAPSED;
            },
            'contentOptions' => ['class' => 'border-left textTr', 'style' => 'border:none'],

        ],
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
    ],
]) ?>
