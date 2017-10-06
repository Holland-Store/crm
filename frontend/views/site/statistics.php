<?php

use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $zakazAll app\models\Zakaz */
/* @var $zakaz app\models\Zakaz */
$this->title = 'Статистика';
?>

<h2><?=Html::encode('Заказы') ?></h2>
<p>
    <?php echo 'Всего: '.$zakazAll ?>
</p>
<div class="col-lg-4">
    <?= ChartJs::widget([
        'type' => 'pie',
        'data' => [
            'labels' => ['Просроченный', 'Все'],
            'datasets' => [
                [
                    'backgroundColor' => ['red', 'green'],
                    'data' => [$zakaz, $zakazAll-$zakaz]
                ],
            ]
        ]
    ]);
    ?>
</div>