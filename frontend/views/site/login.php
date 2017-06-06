<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
// use kartik\widgets\ActiveForm;
// use kartik\label\LabelInPlace;
use yii\bootstrap\ActiveForm;

$this->title = 'Войти';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-3 formLogin">
            <?php $form = ActiveForm::begin(['id' => 'login-form',
            'enableClientValidation' => false,
            'enableClientScript' => false,
            'validateOnBlur' => false]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => false, 'placeholder' => 'Логин'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <!-- <div style="color:#999;margin:1em 0">
                    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                </div> -->

                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
