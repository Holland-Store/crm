<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Personnel */

$this->title = 'Редактировать сотрудника: ' . $model->nameSotrud;
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['shifts']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="personnel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
