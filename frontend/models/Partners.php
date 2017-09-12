<?php

namespace app\models;


/**
 * This is the model class for table "partners".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
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
            [['name'], 'string', 'max' => 50],
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
            'active' => 'Active',
        ];
    }
}
