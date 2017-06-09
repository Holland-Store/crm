<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
?>

<?php $this->registerJs('
$("body").on("click", "#view", function(){
        var key = $(this).data("key");
        $.ajax({
            url: "'.Url::toRoute(['zakaz/zakazold']).'?id="+key,
            success: function(html){
                $(".view-zakaz").html(html);
            }
        })
    });
    $("body").on("click", ".trTable", function(){
        var key = $(this).data("key");
        $.ajax({
            url: "'.Url::toRoute(['zakaz/zakazold']).'?id="+key,
            success: function(html){
                $(".view-zakaz").html(html);
            }
        })  
    })
    ') ?>
<div class="edit-zakaz">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-2">
        <?= $models->data ?>
        <?= $models->idSotrud->name ?>
        <?= $form->field($models, 'name')->textInput() ?>
        <?= $form->field($models, 'phone')->widget(MaskedInput::className(),[
            'mask' => '89999999999'
        ]) ?>
        <?= $form->field($models, 'email')->widget(MaskedInput::className(),[
            'clientOptions' => ['alias' => 'email']
        ]) ?>
    </div>
    <div class="col-lg-7">
        <?= $form->field($models, 'information')->textarea(['max' => 500]); ?>
        <?= $form->field($models, 'number')->textInput(['type' => 'number']); ?>
        <?= $form->field($models, 'file')->fileInput() ?>
    </div>
    <div class="col-lg-3">
        <?= $form->field($models, 'status')->dropDownList([
            '2' => 'Принят',
            '3' => 'Дизайнер',
            '6' => 'Мастер',
            '8' => 'Аутсорс',
            '1' => 'Исполнен',
        ])?>
        <?= $form->field($models, 'time')->textInput(['type' => 'number', 'min' => 0, 'max' => 60])?>
        <?= $models->idShipping->dostavkaName ?>
        <?= $models->maket ?>
    </div>
    <div class="footer-edit-zakaz">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?= Html::button('Вернуться', ['id' => 'view', 'data-key' => $models->id_zakaz]) ?>
</div>
