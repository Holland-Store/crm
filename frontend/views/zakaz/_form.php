<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\file\FileInput;
use app\models\Tovar;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-form">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <!-- <?= $form->field($model, 'id_zakaz')->textInput() ?> -->

    <!-- <?= $form->field($model, 'srok')->textInput() ?> -->
    <div class="col-xs-4">
        <h3>Информация о заказе</h3>
        <div class="col-xs-8">    
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
        <?= $form->field($model, 'number')->textInput(['type'=>'number','min' => '0'])->label('Кол-во') ?>
        </div>
        <div class="col-xs-12">
        <?= $form->field($model, 'information')->textarea(['rows' => 5]) ?>
        </div>
        <div class="col-lg-12">
            <?= $form->field($model, 'file')->widget(FileInput::className(), [
                    'language' => 'ru',
                    'options' => ['multiple' => false],
                    'pluginOptions' => [
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'showPreview' => true,
                        'browseClass' => 'btn btn-success btn-block',
                        'previewFileType' => 'any',
                        'maxFileCount' => 1,
//                        'autoReplace' => false,
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
                        'layoutTemplates' => [
                            'preview' => '<div class="file-preview {class}">
                                <div class="close fileinput-remove">x</div>
                               <div class="{dropClass}">
                               <div class="file-preview-thumbnails">
                                </div>
                                <div class="clearfix"></div>
                                <div class="file-preview-status text-center text-success"></div>
                                <div class="kv-fileinput-error"></div>
                                </div>
                                </div>',
                            'actionDrag' => '<span class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</span>',
                        ],
                    ]
            ]) ?>
            <div class="form-group field-zakaz-file">
            <?php if ($model->img == null) {
                $fileImg = 'Нет выбранных файлов';
            } $fileImg = 'Файл: '.$model->img; ?>
            <?= Html::encode($fileImg) ?>
            </div>
        </div>   
    </div>

    <div class="col-xs-2">
        <h3>Клиент</h3>
        <div class="col-xs-12">
        <?= $form->field($model, 'name')->textInput()->label('Имя клиента') ?>
        </div>
        <div class="col-xs-12">
        <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
            'mask' => '8(999)999-99-99'
        ]) ?>
        </div>
         <div class="col-xs-12">
        <?= $form->field($model, 'email')->widget(MaskedInput::className(),[
            'clientOptions' => ['alias' => 'email']
        ]) ?>
        </div>
    </div>

    <div class="col-xs-2">
        <h3>Оплата</h3>
        <div class="col-xs-10">
            <?= $form->field($model, 'oplata')->textInput(['type' => 'number', 'min' => '0']) ?>
        </div>
        <div class="col-xs-10">
         <?= $form->field($model, 'fact_oplata')->textInput(['type' => 'number', 'min' => '0'])->label('Предоплата') ?>
        </div>
        <div class="col-xs-10">
            <?php if($model->oplata != null){?>
            <label>К доплате</label>
            <p><?php echo $model->oplata - $model->fact_oplata.' рублей'; ?></p>
            <?php } ?>

        </div>
    </div>

    <div class="col-xs-4">
           <h3>Управление</h3>
            <div class="col-xs-10">
            <?= $form->field($model, 'srok')->widget(
                DateControl::className(), [
                'language' => 'ru',
                'type' => DateControl::FORMAT_DATETIME,
//                'displayFormat' => 'php:D, d-MM-Y H:i:s',
                'widgetOptions' => [
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ]
            ])->label('Срок');?>
            </div>
            <div class="col-xs-4">
            <?= $form->field($model, 'minut')->textInput(['type' => 'number', 'min' => '0', 'max' => '24']) ?>
            </div>
            <?php if (Yii::$app->user->can('admin')): ?> 
            <div class="col-xs-10">
                <?= $form->field($model, 'id_tovar')->dropDownList(
                    ArrayHelper::map(Tovar::find()->all(), 'id', 'name'),
                ['prompt' => 'Выберите товар']); ?>
            </div>
            <div class="col-xs-10">      
                <?= $form->field($model, 'status')->dropDownList([
                '2' => 'Принят',
                '3' => 'Дизайнер',
                '6' => 'Мастер',
                '8' => 'Аутсорс',
                '1' => 'Исполнен',
                ],
                ['prompt' => ''])->label('Назначить');?>
                <?= $form->field($model, 'prioritet')->dropDownList([
                '1' => 'важно',
                '2' => 'очень важно'],
                ['prompt' => 'Выберите приоритет']) ?>
            </div>
            <?php endif ?>
            <div class="col-xs-10">
                <?= $form->field($model, 'sotrud_name')->textInput() ?>
            </div>
    </div>

    <!-- <?= $form->field($model, 'id_sotrud')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?> -->


    <!-- <div class="col-xs-12">
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    </div> -->

    <div class="col-xs-7" style="margin-top: 41px;margin-left: 14px;width: 672px;">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success btn-block btn-lg' : 'btn btn-primary btn-block btn-lg']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
