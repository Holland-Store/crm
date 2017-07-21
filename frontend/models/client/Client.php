<?php

namespace app\models\client;


/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property string $fio
 * @property string $phone
 * @property string $email
 * @property string $street
 * @property integer $home
 * @property integer $apartment
 * @property string $address
 */
class Client extends \yii\db\ActiveRecord
{
    public $address;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fio', 'phone'], 'required'],
            [['home', 'apartment'], 'integer'],
            [['fio'], 'string', 'max' => 86],
            [['phone'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 50],
            [['street'], 'string', 'max' => 100],
            [['address'], 'string'],
            [['phone'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'street' => 'Улица',
            'home' => 'Дои',
            'apartment' => 'Квартира',
            'address' => 'Адрес',
        ];
    }
}
