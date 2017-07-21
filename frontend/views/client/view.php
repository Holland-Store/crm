<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\client\Client */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Клиент', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить клиента',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table detail-view'],
        'attributes' => [
            'id',
            'fio',
            'phone',
            'email:email',
            [
                'attribute' => 'address',
                'value' => function($model){
                    if ($model->street == null){
                        return '';
                    } elseif($model->apartment == null){
                        return $model->street.' д.'.$model->home;
                    } else {
                        return $model->street.' д.'.$model->home.' кв.'.$model->apartment;
                    }
                }
            ],
        ],
    ]) ?>

</div>
