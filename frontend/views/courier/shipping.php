<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CourierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доставка';
?>
<?php Pjax::begin(); ?>
<div class="courier-shipping">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id_zakaz',
            [
                'attribute' => 'id_zakaz',
                'format' => 'text',
                'value' => 'idZakaz.description',
                'contentOptions'=>['style'=>'white-space: normal;'],
                'label' => 'Описание',
                'filter' => false,
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'd.m.Y'],
            ],
            'to',
            'from',
            'commit',
            [
                'header' => 'Действие',
                'format' => 'raw',
                'value' => function($model, $key){
                    /**
                     * Если курьер не взял доставку, то админ может в этом случае отменить
                     * в противном случае админ не сможет отменить */
                    return $model->status == 0 ? Html::a('Отменить доставку', ['deletes', 'id' => $model->id]) : '';
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
