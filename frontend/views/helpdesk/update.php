<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Helpdesk */

$this->title = 'Редактирование запроса: ' . $model->id;
<<<<<<< HEAD
//$this->params['breadcrumbs'][] = ['label' => 'Helpdesks', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="helpdesk-update">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
=======
$this->params['breadcrumbs'][] = ['label' => 'Helpdesks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="helpdesk-update">

    <h1><?= Html::encode($this->title) ?></h1>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
