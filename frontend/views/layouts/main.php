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
        <?php $this->registerLinkTag([
        'rel' => 'icon',
        'type' => 'image/x-icon',
        'href' => '/frontend/web/favicon.ico',
    ]);?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
<?php $counts = '<span class="glyphicon glyphicon-bell" style="font-size:21px"></span><span class="badge pull-right">'.$this->params['count'].'</span>'; ?>
    <?php
    // NavBar::begin([
    //     'brandLabel' => 'Holland',
    //     'brandUrl' => ['/zakaz/index'],
    //     'options' => [
    //         'class' => 'navbar-inverse navbar-fixed-top',
    //     ],
    // ]);
    // // $menuItems = [
    // //     ['label' => 'Home', 'url' => ['/site/index']],
    // //     ['label' => 'About', 'url' => ['/site/about']],
    // //     ['label' => 'Contact', 'url' => ['/site/contact']],
    // // ];
    // if (!Yii::$app->user->isGuest) {
    //     $menuItems[] = ['encode' => false, 'label' => $counts, 'options' => ['id' => 'notification']];
    // }
    // if (Yii::$app->user->isGuest) {
    //     $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    // } else {
    //     $menuItems[] = '<li>'
    //         . Html::beginForm(['/site/logout'], 'post')
    //         . Html::submitButton(
    //             'Выйти (' . Yii::$app->user->identity->username . ')',
    //             ['class' => 'btn btn-link logout']
    //         )
    //         . Html::endForm()
    //         . '</li>';
    // }
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => $menuItems,
    // ]);
    // NavBar::end();
    
    if (Yii::$app->user->isGuest) {
        echo '';
    } else {
        echo Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm();
    }
    ?>
    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="notification-container hidden" id="notification-container">
            <div class="notification-content">
                <?php foreach($this->params['notifications'] as $notification){
                $date = date('Y-m-d H:i:s', time());
                    if ($notification->category == 0) {
                        $notif = '<span class="glyphicon glyphicon-road"></span> '.$notification->name.'<br>';
                    } elseif ($notification->category == 1) {
                        $notif = '<span class="glyphicon glyphicon-ok"></span> '.$notification->name.'<br>';
                    } elseif ($notification->category == 2) {
                        $notif = '<span class="glyphicon glyphicon-file"></span> '.$notification->name.'<br>';
                    } elseif ($notification->category == 4 && $notification->srok <= $date){
                        $notif = 'Напоминание о заказе №'.$notification->id_zakaz.' '.$notification->srok;
                    } elseif ($notification->category == 4 && $notification->srok >= $date){
                        $notif = '';
                    }

                   echo Html::a($notif.'<br>', ['notification/notification', 'id' => $notification->id_zakaz], ['id' => $notification->id_zakaz, 'class' => 'zakaz', 'data-key' => $notification->id_zakaz]);            
                } 
                ?>
            </div>
            <div class='notification-footer'>
            <?php echo Html::a('Прочитать все напоминание', ['notification/index']) ?>
            </div>
        </div>  
    <?php endif ?>

<?php if (Yii::$app->user->isGuest): ?>
    <div class="headerLogin">
        <h1>HOLLAND <span>CRM 3.0</span></h1>
        <p>Управление заказами</p>
    </div>
<?php endif ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Главная', 'url' => ['zakaz/index']],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php echo Nav::widget([
            'options' => ['class' => 'nav nav-pills'],
            'items' => [
            ['label' => 'Администратор', 'url' => ['zakaz/admin'], 'visible' => Yii::$app->user->can('seeAdmin')],
            ['label' => 'Дизайнер', 'url' => ['zakaz/disain'], 'visible' => Yii::$app->user->can('disain')],
            ['label' => 'Готовые заказы', 'url' => ['zakaz/ready'], 'visible' => Yii::$app->user->can('disain')],
            ['label' => 'Мастер', 'url' => ['zakaz/master'], 'visible' => Yii::$app->user->can('master')],
            ['label' => 'Прием заказов', 'url' => ['zakaz/shop'], 'visible' => Yii::$app->user->can('seeShop')],
            ['label' => 'Закрытые заказы', 'url' => ['zakaz/archive'], 'visible' => Yii::$app->user->can('seeAdmin')],
            ['label' => 'Курьер', 'url' => ['courier/index'], 'visible' => Yii::$app->user->can('courier')],
            ['label' => 'Закрытые заказы', 'url' => ['zakaz/closezakaz'], 'visible' => Yii::$app->user->can('seeShop')],
            ['label' => 'Готовые доставки', 'url' => ['courier/ready'], 'visible' => Yii::$app->user->can('courier')],
            ['label' => 'Прочее', 'items' => [
                ['label' => 'Задачник', 'url' => ['todoist/index'], 'visible' => Yii::$app->user->can('admin')],
                ['label' => 'Выполненые задачи', 'url' => ['todoist/closetodoist'], 'visible' => Yii::$app->user->can('admin')],
                ['label' => 'Задачи', 'url' => ['todoist/shop'], 'visible' => Yii::$app->user->can('shop')],
                ['label' => 'Help Desk', 'url' => ['helpdesk/index']],
                ['label' => 'Запросы на товар', 'url' => ['custom/adop'], 'visible' => Yii::$app->user->can('shop')],
            ], 'visible' => Yii::$app->user->can('seeAdop')],
            ['label' => 'Создать запрос', 'url' => ['todoist/create_shop'], 'visible' =>Yii::$app->user->can('shop'), 'items' => [
                ['label' => 'Helpdesk', 'url' => ['todoist/create_shop'], 'visible' => Yii::$app->user->can('shop')],
                ['label' => 'Запрос на товар', 'url' => ['todoist/create_shop'], 'visible' => Yii::$app->user->can('shop')],
            ],
            ],
            ['label' => 'Запросы на товар', 'url' => ['custom/index'], 'visible' => Yii::$app->user->can('zakup')],
            ['label' => 'Задачник', 'url' => ['todoist/shop'], 'visible' => Yii::$app->user->can('todoist')],
            ['label' => 'Help Desk', 'url' => ['helpdesk/index'], 'visible' => Yii::$app->user->can('todoist')],
            ],
        ]); ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Holland <?= date('Y'); ?> <?= Html::a('version 2.0', ['zakaz/index']) ?></p>

        <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
    <!--</div>
</footer> -->
<?php if (Yii::$app->user->isGuest): ?>
    <footer>
        <div class="footerLogin">
            <img src="img/logo.png" title="Logo">
            <div>Сеть магазинов</div>
            <div>&copy Holland <?php echo date('Y') ?></div>
        </div>
    </footer>
<?php endif ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
