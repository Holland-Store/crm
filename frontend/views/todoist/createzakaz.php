<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Todoist */

$this->title = 'Добавить задачу к заказу '.Yii::$app->request->get('id_zakaz');
// $this->params['breadcrumbs'][] = ['label' => 'Todoists', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="todoist-create">

<<<<<<< HEAD
=======
    <h1><?= Html::encode($this->title) ?></h1>

>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
    <?= $this->render('_formzakaz', [
        'model' => $model,

    ]) ?>

</div>
