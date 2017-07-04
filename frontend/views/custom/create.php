<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Custom */

$this->title = 'Создание запроса';
<<<<<<< HEAD
//$this->params['breadcrumbs'][] = ['label' => 'Customs', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-create">

    <?= $this->render('_form', [
        'models' => $models,
=======
$this->params['breadcrumbs'][] = ['label' => 'Customs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="custom-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
    ]) ?>

</div>
