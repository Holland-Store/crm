<?php

namespace app\models;

use yii\db\ActiveRecord;


/**
 * This is the model class for table "personnel".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $name
 * @property string $phone
 */
class Personnel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personnel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_name', 'name', 'phone'], 'required'],
            [['last_name', 'name'], 'string', 'max' => 50],
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
            'last_name' => 'Last Name',
            'name' => 'Name',
            'phone' => 'Phone',
        ];
    }
}
