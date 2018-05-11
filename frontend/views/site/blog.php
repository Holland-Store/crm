<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use frontend\models\NumberColumn;

$dataProvider = new ActiveDataProvider([
    'query' => \app\models\Zakaz::find()
        ->where('action <= 0') ->andWhere( 'data >= (CURDATE()-1) AND data < CURDATE()')
        ->groupBy('data'),
    'pagination' => [
        'pageSize' => 10,
    ],
]);

$Articles = new ActiveDataProvider([
    'query' => \app\models\Zakaz::find()
       /* ->select('DATE_FORMAT("data, "%m-%Y") as data')*/
        ->where('action <= 0') ->andWhere('data >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)'),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
$this->title = 'За неделю';
$this->params['breadcrumbs'][] = $this->title;
print_r ($arrayInView);

?>
<div id="analytic"  class="site-about">
    <h1><?= Html::encode('Вчера') ?></h1>
    <?php echo GridView::widget([
        'dataProvider' =>$dataProvider ,
        'showFooter' => true,
        'columns' => [
            [
                'attribute' => 'data',
                'format' => ['date', ' dd.MM.YYYY'],
                'options' => ['width' => '200']

            ],
            [
                'class' => NumberColumn::className(),
                'attribute' => 'fact_oplata',
            ],
        ],
    ]);
    ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo GridView::widget([
        'dataProvider' => $Articles,
        'showFooter' => true,
        'filterModel'=>$searchModel,
        'showPageSummary'=>true,
        'pjax'=>true,
        'striped'=>true,
        'hover'=>true,
        'panel'=>['type'=>'primary', 'heading'=>'За неделю'],
        'columns' => [
            [
                'attribute'=>'data',
                'format' => ['date', ' dd.MM.YYYY'],
                'width'=>'310px',
                'value'=>function ($model, $key, $index, $widget) {
                    return $model->data;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(\app\models\Zakaz::find()->orderBy('data')->asArray()->all(), 'id_zakaz', 'data'),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Any supplier'],
                'group'=>true, // enable grouping
                'pageSummary'=>'Итого',
                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
            ],

            [
               /* 'class' => NumberColumn::className(),*/
                'attribute' => 'fact_oplata',
                'pageSummary'=>true,

            ],

        ],
    ]);;?>
</div>