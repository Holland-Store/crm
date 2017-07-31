<?php

namespace frontend\components;

use app\models\User;


$output = json_decode(file_get_contents('php://input'), true);
file_put_contents('logs.txt', $output);
$token = '414134665:AAHfOIdeikQD04NdKckL8wadhqzggvmSqw0';

$message = $output['message'];
$id = $message['chat']['id'];

$model = User::findOne(\Yii::$app->user->id);
$model->telegram_chat_id = $id;
$model->save();

$webSite = 'https://api.telegram.org/bot'.$token;

