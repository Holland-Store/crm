<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */

<<<<<<< HEAD
$this->title = 'Заказ: ' . $model->id_zakaz;
//$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['admin']];
//$this->params['breadcrumbs'][] = ['label' => $model->id_zakaz, 'url' => ['admin', '#' => $model->id_zakaz]];
//$this->params['breadcrumbs'][] = 'Редактировать';
=======
$this->title = 'Редактировать заказ: ' . $model->id_zakaz;
$this->params['breadcrumbs'][] = ['label' => 'Заказ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_zakaz, 'url' => ['view', 'id' => $model->id_zakaz]];
$this->params['breadcrumbs'][] = 'Редактировать';
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
?>
<div class="zakaz-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
