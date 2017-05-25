<?php

use yii\helpers\Html;
use app\models\Otdel;
use app\models\Zakaz;
use yii\bootstrap\Nav;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ZakazSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php Pjax::begin(); ?>
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
    ['label' => 'Прочее', 'items' => [
        ['label' => 'Задачник', 'url' => ['todoist/index'], 'visible' => Yii::$app->user->can('admin')],
		['label' => 'Задачи', 'url' => ['todoist/shop'], 'visible' => Yii::$app->user->can('shop')],
        ['label' => 'Help Desk', 'url' => ['helpdesk/index']],
        ['label' => 'Запросы на товар', 'url' => ['custom/adop'], 'visible' => Yii::$app->user->can('shop')],
    ], 'visible' => Yii::$app->user->can('seeAdop')],
	['label' => 'Создать запрос', 'url' => ['todoist/create_shop'], 'visible' =>Yii::$app->user->can('shop')],
	['label' => 'Запросы на товар', 'url' => ['custom/index'], 'visible' => Yii::$app->user->can('zakup')],
    ],
]); ?>

<h1>Добро пожаловать</h1>

<p>
	<h4>Версия 1.0<h4>
	<ul>
		<li>Создание таблицы</li>
		<li>Взаимодействие с отделами</li>
		<li>Сохрание и загрузка файлов</li>
		<li>Создание и редактирование заказов</li>
	</ul>
    <hr>
    <h4>Версия 1.1<h4>
    <ul>
        <li>Добавлено поле "сотрудник" в создание заказа</li>
        <li>Оптимизирована таблица</li>
        <li>В id указывается префикс</li>
        <li>У дизайнер добавлены внутренние этапы</li>
        <li>Убран во всех заказах магазин</li>
        <li>Теперь может магазин закрывать заказы</li>
        <li>Заказ можно закрыть только в том случае, если он в статусе исполнен</li>
    </ul>
    <hr>
    <h4>Версия 2.0<h4>
    <ul>
        <li>Созданы уведомление</li>
        <li>Реализована у администратора условное форматирование. При просроченном сроке цвет строки меняется на красный. Новые заказы меняются на жирный шрифт</li>
        <li>Умный тотальный поиск</li>
        <li>Добавлен задачник, helpdesk, запросы на получение товара</li>
        <li>Задачу можно прикреплять внутри заказа</li>
        <li>Преобразована ссылка, на более удобную</li>
        <li>У магазина убраны этапы</li>
        <li>Магазин может искать заказ по части имени</li>
        <li>После авторизации переходит на экран заказов</li>
        <li>Создана роль закупщика</li>
        <li>Кликабельность заказов в таблице</li>
    </ul>
    <hr>
</p>


<div class="alert alert-info col-xs-4"><h2>Тех поддержка:</h2><br><span class="glyphicon glyphicon-earphone"></span> 89503164233 <br>
<span>@</span> holland.itkzn@gmail.com</div>

<div>Предлжение и технические неисправности писать <a href="http://crm.holland-store.ru/frontend/web/index.php?r=site%2Fcontact">сюда</a></div>
<?php Pjax::end(); ?>
