<?php

use app\models\Zakaz;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
<<<<<<< HEAD
use kartik\datetime\DateTimePicker;
use kartik\datecontrol\DateControl;
use kartik\file\FileInput;
use app\models\Tovar;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

=======
use dosamigos\datepicker\DatePicker;
use app\models\Tovar;
use app\models\Zakaz;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
/* @var $this yii\web\View */
/* @var $model app\models\Zakaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-form">
    <?php $form = ActiveForm::begin([
<<<<<<< HEAD
        'options' => ['enctype' => 'multipart/form-data'],
        'enableClientScript' => false,
        'validateOnBlur' => false,
    ]); ?>

    <div class="col-xs-4 informationZakaz">
        <h3>Информация о заказе</h3>
        <div class="col-xs-8">    
        <?= $form->field($model, 'description')->textInput(['maxlength' => true, 'placeholder' => 'Описание', 'class' => 'inputForm'])->label(false) ?>
        </div>
        <div class="col-xs-4">
        <?= $form->field($model, 'number')->textInput(['type'=>'number','min' => '0', 'placeholder' => 'Кол-во', 'class' => 'inputForm'])->label(false) ?>
        </div>
        <div class="col-xs-12">
        <?= $form->field($model, 'information')->textarea(['rows' => 3, 'placeholder' => 'Дополнительная информация'])->label(false) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'file')->widget(FileInput::className(), [
                    'language' => 'ru',
                    'options' => ['multiple' => false],
                    'pluginOptions' => [
                        'theme' => 'explorer',
                        'showCaption' => false,
                        'showRemove' => false,
                        'showUpload' => false,
                        'showPreview' => true,
                        'browseClass' => 'action fileInput',
                        'browseLabel' =>  'Загрузить файл',
                        'previewFileType' => 'any',
                        'maxFileCount' => 1,
//                        'autoReplace' => false,
                        'preferIconicPreview' => true,
                        'previewFileIconSettings' => ([
                            'doc' => '<i class="fa fa-file-word-o text-orange"></i>',
                            'docx' => '<i class="fa fa-file-word-o text-orange"></i>',
                            'xls' => '<i class="fa fa-file-excel-o text-orange"></i>',
                            'xlsx' => '<i class="fa fa-file-excel-o text-orange"></i>',
                            'ppt' => '<i class="fa fa-file-powerpoint-o text-orange"></i>',
                            'pdf' => '<i class="fa fa-file-pdf-o text-orange"></i>',
                            'zip' => '<i class="fa fa-file-archive-o text-orange"></i>',
                            'rar' => '<i class="fa fa-file-archive-o text-orange"></i>',
                            'txt' => '<i class="fa fa-file-text-o text-orange"></i>',
                            'jpg' => '<i class="fa fa-file-photo-o text-orange"></i>',
                            'png' => '<i class="fa fa-file-photo-o text-orange"></i>',
                            'gif' => '<i class="fa fa-file-photo-o text-orange"></i>',
                        ]),
                        'layoutTemplates' => [
                            'preview' => '<div class="file-preview {class}">
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
            ])->label(false) ?>
            <div class="form-group field-zakaz-file">
            <?php if ($model->img == null) {
                $fileImg = '';
            } else {
                $fileImg = 'Файл: ' . $model->img;
            }
            ?>
=======
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
        <div class="col-lg-5">
            <?= $form->field($model, 'file')->fileInput() ?>
            <?php  ?>
            <div class="form-group field-zakaz-file">
            <?php if ($model->img == null) {
                $fileImg = 'Нет выбранных файлов';
            } $fileImg = 'Файл: '.$model->img; ?>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
            <?= Html::encode($fileImg) ?>
            </div>
        </div>   
    </div>

<<<<<<< HEAD
    <div class="col-xs-2 clientZakaz">
        <h3>Клиент</h3>
        <div class="col-xs-12">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Имя клиента', 'class' => 'inputForm'])->label(false) ?>
        </div>
        <div class="col-xs-12">
        <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
            'mask' => '89999999999',
        ])->label(false) ?>
=======
    <div class="col-xs-2">
        <h3>Клиент</h3>
        <div class="col-xs-12">
        <?= $form->field($model, 'name')->textInput()->label('Имя клиента') ?>
        </div>
        <div class="col-xs-12">
        <?= $form->field($model, 'phone')->widget(MaskedInput::className(),[
            'mask' => '89999999999'
        ]) ?>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        </div>
         <div class="col-xs-12">
        <?= $form->field($model, 'email')->widget(MaskedInput::className(),[
            'clientOptions' => ['alias' => 'email']
<<<<<<< HEAD
        ])->label(false) ?>
        </div>
    </div>

    <div class="col-xs-2 moneyZakaz">
        <h3>Оплата</h3>
        <div class="col-xs-10">
            <?= $form->field($model, 'oplata')->textInput(['type' => 'number', 'min' => '0', 'placeholder' => 'Всего', 'class' => 'inputForm'])->label(false) ?>
        </div>
        <div class="col-xs-10">
         <?= $form->field($model, 'fact_oplata')->textInput(['type' => 'number', 'min' => '0', 'placeholder' => 'Предоплата', 'class' => 'inputForm'])->label(false) ?>
        </div>
        <div class="col-xs-10">
            <?php if($model->oplata != null){?>
            <label>К доплате</label>
            <p><?php echo $model->oplata - $model->fact_oplata.' рублей'; ?></p>
            <?php } ?>

        </div>
    </div>

    <div class="col-xs-4 managmentZakaz">
           <h3>Управление</h3>
            <div class="col-xs-10">
                <?= $form->field($model, 'srok')->widget(DateControl::className(),
                    [
                        'convertFormat' => true,
                        'type'=>DateControl::FORMAT_DATETIME,
                        'displayFormat' => 'php:d M Y H:i',
                        'saveFormat' => 'php:Y-m-d H:i:s',
                    ])->label(false);?>
            </div>
            <?php if (Yii::$app->user->can('admin')): ?> 
<!--            <div class="col-xs-10">-->
<!--                --><?//= $form->field($model, 'id_tovar')->dropDownList(
//                    ArrayHelper::map(Tovar::find()->all(), 'id', 'name'),
//                ['prompt' => 'Выберите товар'])->label(false); ?>
<!--            </div>-->
            <div class="col-xs-10">      
                <?= $form->field($model, 'status')->dropDownList([
                Zakaz::STATUS_DISAIN => 'Дизайнер',
                Zakaz::STATUS_MASTER => 'Мастер',
                Zakaz::STATUS_AUTSORS => 'Аутсорс',
                ],
                ['prompt' => 'Назначить'])->label(false);?>
                <?= $form->field($model, 'prioritet')->dropDownList([
                '1' => 'важно',
                '2' => 'очень важно'],
                ['prompt' => 'Выберите приоритет'])->label(false) ?>
            </div>
            <?php endif ?>
            <?php if (Yii::$app->user->can('shop')): ?>
            <div class="col-xs-10">
                <?= $form->field($model, 'sotrud_name')->textInput(['placeholder' => 'Сотрудник', 'class' => 'inputForm'])->label(false) ?>
            </div>
            <?php endif ?>
    </div>

    <!-- <?= $form->field($model, 'id_sotrud')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?> -->

    <div class="col-lg-2 submitZakazForm">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'action' : 'action']) ?>
=======
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
            <div class="col-xs-6">
            <?= $form->field($model, 'srok')->widget(
                DatePicker::className(), [
                    'inline' => false, 
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
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
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
