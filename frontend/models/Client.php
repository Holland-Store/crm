<?php

namespace app\models;

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
 *
 * @property Zakaz[] $zakazs
 */
class Client extends \yii\db\ActiveRecord
{
    public $address;

    const SCENARIO_DEFAULT = 'default';
    const SCENARIO_CREATE = 'create';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @return array
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['id', 'fio', 'phone', 'emaail', 'home','street', 'apartment'],
            self::SCENARIO_CREATE => ['id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required', 'message' => 'Пожалуйста, заполните поле','on' => self::SCENARIO_CREATE],
            [['fio', 'phone'], 'required', 'on' => self::SCENARIO_DEFAULT],
            [['home', 'apartment'], 'integer'],
            [['phone'], 'number'],
            [['fio'], 'string', 'max' => 86],
            [['email'], 'string', 'max' => 50],
            [['street'], 'string', 'max' => 100],
            [['phone'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Фио',
            'phone' => 'Телефон',
            'email' => 'Email',
            'street' => 'Улица',
            'home' => 'Дом',
            'apartment' => 'Квартира',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZakazs()
    {
        return $this->hasMany(Zakaz::className(), ['id_client' => 'id']);
    }
}
