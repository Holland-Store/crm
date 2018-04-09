<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Уведомление';
?>
<div class="notification-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Отметить все прочитаным', ['ready', 'id' => Yii::$app->user->id])  ?>
    <br>
    
    <?php foreach ($model as $notification): ?>
       <?php $date = date('Y-m-d H:i:s', time()) ?>
        <?php  echo Html::tag('p',Html::a($notification->name, ['notification', 'id' => $notification->id_zakaz]),['style'=>$notification->active == 1?'font-weight: bold;':'']);
        ?>

    <?php endforeach ?>
</div>
