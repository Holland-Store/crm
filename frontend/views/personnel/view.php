<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Shifts */
/* @var $modelPersonnel app\models\Personnel */
/* @var $position app\models\Position */
/* @var $sumShifts app\models\Shifts */
/* @var $sumFinancy app\models\Financy */
/* @var $financy app\models\Financy */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $modelPersonnel->nameSotrud;
?>

<div class="col-lg-12">
    <?=Html::submitButton('Назначить', [
            'class' => 'btn btn-success financy',
            'value' => \yii\helpers\Url::to(['financy/charge', 'id' => $modelPersonnel->id])
        ]) ?>
    <?php Modal::begin([
        'id' => 'financeModel'
    ]);
    echo '<div class="modalContent"></div>';
    Modal::end()?>
</div>
<div class="col-lg-4">
    <h4><?php echo 'График работы '.$modelPersonnel->sheduleName ?></h4>
    <h3><?=Html::encode('Смены') ?></h3>
        <?php if (!$model){
            echo 'Ничего не найдена';
        } else {
            echo '<table>
            <tr>
                <th>Дата</th>
                <th>Количество часов</th>
            </tr>';
            foreach ($model as $shifts){
                echo '<tr><td style="padding: 8px">'.Yii::$app->formatter->asDate($shifts->start).'</td>
                <td style="padding: 8px">'.(date('H', $shifts->number)*1).'</td></tr>';
            }
            /** @var string $sumShifts */
            echo '<tr>
            <th>Итого</th>
            <th>'.(date('H', $sumShifts)*1).' часов</th>
        </tr>
    </table>';
    }?>
</div>
<div class="col-lg-5">
    <h3><?=Html::encode('Штрафы/Премия') ?></h3>
    <?php if (!$financy){
        echo 'Ничего не найдена';
    } else {
        echo '<table>';
        echo '<tr>
                <th>Дата</th>
                <th>Сумма</th>
                <th>Коммент</th>
                <th>Штраф/Премия</th>
</tr>';
        foreach ($financy as $fin) {
            echo '<tr><td style="padding: 8px">'.$fin->date.'</td>
            <td style="padding: 8px">'.$fin->sum.' рублей</td>
            <td style="padding: 8px">'.$fin->comment.'</td>
            <td style="padding: 8px">'.$fin->categoryName.'</td></tr>';
        }
        /** @var string $sumFinancy */
        echo '<tr>
            <th>Итого</th>
            <th>'.$sumFinancy.' рублей</th>
        </tr>';
'</table>';
    }?>
</div>
<div class="col-lg-3">
    <h3><?= Html::encode('Зарплата') ?></h3>
    <div>Оклад:
        <?php foreach ($modelPersonnel->positions as $key => $value){
            echo number_format($value->salary, 0, ',', ' ').' рублей<br>';
        } ?>
    </div>
    <div>Премия: <?php echo $modelPersonnel->bonus.' рублей' ?></div>
    <div>Итого: <?php echo 55.56*date('G,i', $sumShifts+16400) ?></div>
</div>
<div class="col-lg-12">
</div>