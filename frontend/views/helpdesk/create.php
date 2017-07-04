<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Helpdesk */

$this->title = 'Создание запроса';
<<<<<<< HEAD
//$this->params['breadcrumbs'][] = ['label' => 'Helpdesks', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="helpdesk-create">

=======
$this->params['breadcrumbs'][] = ['label' => 'Helpdesks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="helpdesk-create">

    <h1><?= Html::encode($this->title) ?></h1>

>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
