<?php
namespace frontend\models;

use common\models\User;

class Telegram
{
    public static function start($data){
        return self::login($data);
    }

    /**
     * @param $data
     * @return string
     */
    public static function login($data)
    {
        $token = $data['raw'];
        if ($token && $user = User::findOne(['token' => $token])) {
            if ($user->telegram_chat_id) {
                return "Уважаемый $user->name, Вы уже авторизованы в системе. ";
            }
            $user->telegram_chat_id = $data['chat_id'];
            $user->save();
            return "Добро пожаловать, $user->name. Вы успешно авторизовались!";
        } else {
            return "Извините, не удалось найти данный токен!";
        }
    }
}