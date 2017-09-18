<?php

namespace app\models;


/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $contact_person
 * @property string $email
 * @property string $web
 * @property string $specialization
 * @property integer $active
 */
class Partners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'active'], 'required'],
            [['active'], 'integer'],
            [['name', 'contact_person', 'email', 'web', 'specialization'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 86],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'Телефон',
            'web' => 'Телефон',
            'specialization' => 'Телефон',
            'contact_person' => 'Контактное лицо',
            'active' => 'Active',
        ];
    }
}
