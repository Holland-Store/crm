<?php

use yii\helpers\Html;
use app\models\Otdel;
use app\models\Zakaz;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php echo Nav::widget([
    'options' => ['class' => 'nav nav-pills'],
    'items' => [
    ['label' => 'Главная', 'url' => ['zakaz/index']],
    ['label' => 'Администратор', 'url' => ['zakaz/admin'], 'visible' => Yii::$app->user->can('seeAdmin')],
    ['label' => 'Дизайнер', 'url' => ['zakaz/disain'], 'visible' => Yii::$app->user->can('seeDisain')],
    ['label' => 'Мастер', 'url' => ['zakaz/master'], 'visible' => Yii::$app->user->can('seeMaster')],
    ['label' => 'Магазин', 'url' => ['zakaz/shop'], 'visible' => Yii::$app->user->can('seeShop')],
    ],
]); ?>

<h1>Добро пожаловать</h1>