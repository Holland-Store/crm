<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonnelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personnel-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered'],
        'columns' => [
            [
                'attribute' => 'nameSotrud',
            ],
            [
                'attribute' => 'phone',
            ],
            [
               'attribute' => 'positions',
                'filter' => \app\models\Position::find()->select(['name', 'id'])->indexBy('id')->column(),
                'value' => 'positionsAsString',
            ],
            [
                'attribute' => 'job_duties',
                'value' => function($model){
                    return $model->job_duties != null ? $model->job_duties : false;
                }
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
