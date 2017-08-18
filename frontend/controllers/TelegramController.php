<?php

namespace frontend\controllers;

use app\models\User;
use yii\db\Exception;
use yii\web\Controller;

/**
 * Telegram controller
 */
class TelegramController extends Controller
{
    public function actionWebhook()
    {
        try{
            \Yii::$app->bot->setWebhook(['url' => ['index']]);
        } catch (Exception $e){
            $e->getMessage();
        }
    }

    public function actionIndex()
    {
        try{
            $content = json_decode(file_get_contents('php://input'));
            $chatId = $content['callback_query']['message']['chat']['id'];
            file_put_contents('logs.txt', $chatId);
//             \Yii::$app->bot->sendMessage(119296878, 'Hello World');

            $user = User::findOne(\Yii::$app->user->id);
            $user->telegram_chat_id = $chatId;
            $user->save();
        } catch (Exception $e){
            $e->getMessage();
        }
    }
}