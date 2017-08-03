<?php

use aki\telegram\Telegram;
use app\models\User;

$bot = new Telegram();

$content = json_decode(file_get_contents('php://input'));
$message = $content['callback_query']['message'];
$chatId = $message['chat']['id'];
file_put_contents('logs.txt', $chatId);
$token = '414134665:AAHfOIdeikQD04NdKckL8wadhqzggvmSqw0';

$model = User::findOne(\Yii::$app->user->id);
$model->telegram_chat_id = $chatId;
$model->save();

$webSite = 'https://api.telegram.org/bot'.$token;