<?php
/* @var $this yii\web\View */
/* @var $model app\models\Personnel */
/* @var $count app\models\Personnel */
?>
<h1>Сотрудники</h1>

<p>
    <?php foreach ($model as $sotrud){
        $n++;
        echo $n.''.$sotrud->last_name.' '.$sotrud->name.' '.$sotrud->phone.' '.$sotrud->idPosition->name.'<br>';
    } ?>
</p>
