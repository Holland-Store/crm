<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use app\models\Notification;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Holland',
        'brandUrl' => ['/zakaz/index'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    // $menuItems = [
    //     ['label' => 'Home', 'url' => ['/site/index']],
    //     ['label' => 'About', 'url' => ['/site/about']],
    //     ['label' => 'Contact', 'url' => ['/site/contact']],
    // ];
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = ['encode' => false, 'label' => '<span class="glyphicon glyphicon-bell"></span>', 'options' => ['id' => 'notification']];
    }
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="notification-container hidden" id="notification-container">
        <?php foreach($this->params['notifications'] as $notification){
            // Действия с экземпляром модели Notification, например
            if ($notification->category == 0) {
                $notif = '<span class="glyphicon glyphicon-road"></span> '.$notification->name.'<br>';
            } elseif ($notification->category == 1) {
                $notif = '<span class="glyphicon glyphicon-ok"></span> '.$notification->name.'<br>';
            } elseif ($notification->category == 2) {
                $notif = '<span class="glyphicon glyphicon-file"></span> '.$notification->name.'<br>';
            }

           echo Html::a($notif.'<br>', ['notification/view', 'id' => $notification->id_zakaz]);            
        } 
        ?>
        <div class='notification-footer'>
        <?php echo Html::a('Прочитать все напоминание', ['#']) ?>
        </div>
        </div>
    <?php endif ?>
    

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Главная', 'url' => ['zakaz/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Holland <?= date('Y'); ?> version 1.1</p>

        <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
