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
        <?php if ($notification->category == 0) {
            $notif = '<span class="glyphicon glyphicon-road"></span> '.$notification->name.'<br>';
        } elseif ($notification->category == 1) {
            $notif = '<span class="glyphicon glyphicon-ok"></span> '.$notification->name.'<br>';
        } elseif ($notification->category == 2) {
            $notif = '<span class="glyphicon glyphicon-file"></span> '.$notification->name.'<br>';
        } elseif($notification->category == 4){
            $notif = $model->name.' '.date('Y-m-d H:i:s', $model->srok);
        }
        echo Html::tag('p',Html::a($notif, ['notification', 'id' => $notification->id_zakaz]),['style'=>$notification->active == 1?'font-weight: bold;':'']);
    ?>

    <?php endforeach ?>
</div>
