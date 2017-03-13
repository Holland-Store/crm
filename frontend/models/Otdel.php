<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "otdel".
 *
 * @property integer $id_sotr
 * @property string $fio
 * @property string $otdel
 * @property string $thePost
 * @property string $login
 * @property string $password
 * @property string $auth_key
 * @property string $accessToken
 */
class Otdel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otdel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sotr', 'fio', 'otdel', 'thePost', 'login', 'password', 'auth_key', 'accessToken'], 'required'],
            [['id_sotr'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            [['otdel', 'thePost', 'login', 'auth_key', 'accessToken'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_sotr' => 'Id Sotr',
            'fio' => 'Fio',
            'otdel' => 'Otdel',
            'thePost' => 'The Post',
            'login' => 'Login',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }
}