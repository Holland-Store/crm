<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;


$dataProvider = new ActiveDataProvider([
    'query' => \app\models\Zakaz::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
]);

$this->title = 'Аналитика';
$this->params['breadcrumbs'][] = $this->title;

print_r ($arrayInView);

?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($varInView as $item): ?>
        <h5><?php echo $item->data ?></h5>
        <h5><?php echo $item->fact_oplata ?></h5>

    <?php endforeach ?>

</div>




