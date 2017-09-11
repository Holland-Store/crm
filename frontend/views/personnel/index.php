<?php

use kartik\widgets\Alert;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonnelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакты';
?>
<div class="personnel-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Alert::widget([
            'options' => ['class' => 'infoContact'],
            'body' => '<b>Внимание!</b> Если у Вас не форс-мажор или особая ситуация, не терпящая отлагательств (срочный крупный заказ; разгневанный клиент; любые контролирующие органы; поломка, которая сильно влияет на процесс работы), просьба звонить коллегам только в их рабочее время. Если все же случилась особая ситуация, то, в первую очередь, просьба обращаться к своему непосредственному руководителю. Если он не отвечает - то его руководителю, и так далее.'
        ]) ?>
    </p>

<?php Pjax::begin(); ?>
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'tableOptions' => ['class' => 'table table-bordered'],
//        'showHeader' => false,
//        'columns' => [
//            [
//                'attribute' => 'positions',
//                'filter' => \app\models\Position::find()->select(['name', 'id'])->indexBy('id')->column(),
//                'value' => 'positionsAsString',
//            ],
//            [
//                'attribute' => 'nameSotrud',
//            ],
//            [
//                'attribute' => 'phone',
//            ],
//            [
//                'attribute' => 'shedule',
//                'value' => function($model){
//                    return $model->shedule != null ? $model->shedule : false;
//                },
//            ],
//            [
//                'attribute' => 'job_duties',
//                'value' => function($model){
//                    return $model->job_duties != null ? $model->job_duties : false;
//                }
//            ],
//        ],
//    ]); ?>

<?php Pjax::end(); ?></div>
