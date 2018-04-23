<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use frontend\models\NumberColumn;

$dataProvider = new ActiveDataProvider([
    'query' => \app\models\Zakaz::find()
       /* ->select('DATE_FORMAT(date, "%d-%M") as data')*/
        ->where('action <= 0') ->andWhere( 'data >= (CURDATE()-1) AND data < CURDATE()')
        ->groupBy('data'),
    'pagination' => [
        'pageSize' => 10,
    ],
]);
$Articles = new ActiveDataProvider([
    'query' => \app\models\Zakaz::find()
        ->where('action <= 0') ->andWhere('data >= DATE_SUB(CURRENT_DATE, INTERVAL 7 DAY)'),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

$this->title = 'За неделю';
$this->params['breadcrumbs'][] = $this->title;
print_r ($arrayInView);

?>
<div class="site-about">
    <h1><?= Html::encode('Вчера') ?></h1>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'showFooter' => true,
        'columns' => [
            [
                'attribute' => 'data',
                'format' =>  ['date', ' dd.MM.YYYY'],
                'options' => ['width' => '200']

            ],
            [
                'class' => NumberColumn::className(),
                'attribute' => 'fact_oplata',
            ],
        ],
    ]); ?>
    <h1><?= Html::encode($this->title) ?></h1>
<?php echo GridView::widget([
    'dataProvider' =>$Articles ,
    'showFooter' => true,
    'columns' => [
        [
            'attribute' => 'data',
            'format' =>  ['date', ' dd.MM.YYYY'],
            'options' => ['width' => '200']

        ],
        [
            'class' => NumberColumn::className(),
            'attribute' => 'fact_oplata',
        ],
    ],
]);

?>
</div>



