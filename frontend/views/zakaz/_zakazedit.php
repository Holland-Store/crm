<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\MaskedInput;
use kartik\file\FileInput;
?>

<?php $this->registerJs('
$("body").on("click", "#view", function(){
        var key = $(this).data("key");
        $.ajax({
            url: "'.Url::toRoute(['zakaz/zakaz']).'?id="+key,
            success: function(html){
                $(".view-zakaz").html(html);
            }
        })
    });
    $("body").on("click", ".trTable", function(){
        var key = $(this).data("key");
        $.ajax({
            url: "'.Url::toRoute(['zakaz/zakaz']).'?id="+key,
            success: function(html){
                $(".view-zakaz").html(html);
            }
        })  
    })
    ') ?>
<div class="edit-zakaz">
    <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
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
        <?php //$form->field($models, 'file')->fileInput() ?>
        <?=$form->field($models, 'file')->widget(FileInput::className(), [
            'language' => 'ru',
            'options' => ['multiple' => false],
            'pluginOptions' => [
                'showCaption' => false,
                'showRemove' => false,
                'showUpload' => false,
                'showPreview' => true,
                'browseClass' => 'btn btn-success',
                'uploadClass' => 'btn btn-info',
                'removeClass' => 'btn btn-danger',
                'previewFileType' => 'any',
                'maxFileCount' => 1,
                'autoReplace' => true,
                'theme' => 'explorer',
                'preferIconicPreview' => true,
                'previewFileIconSettings' => ([
                    'doc' => '<i class="fa fa-file-word-o text-primary"></i>',
                    'xls' => '<i class="fa fa-file-excel-o text-success"></i>',
                    'ppt' => '<i class="fa fa-file-powerpoint-o text-danger"></i>',
                    'pdf' => '<i class="fa fa-file-pdf-o text-danger"></i>',
                    'zip' => '<i class="fa fa-file-archive-o text-muted"></i>',
                    'rar' => '<i class="fa fa-file-archive-o text-muted"></i>',
                    'txt' => '<i class="fa fa-file-text-o text-info"></i>',
                    'jpg' => '<i class="fa fa-file-photo-o text-danger"></i>',
                    'png' => '<i class="fa fa-file-photo-o text-danger"></i>',
                    'gif' => '<i class="fa fa-file-photo-o text-danger"></i>',
                ]),
                'layoutTemplates' => ([
                        'actionDelete' => '',
                        'actionUpload' => '',
                    ]),
            ],
        ]) ?>
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
