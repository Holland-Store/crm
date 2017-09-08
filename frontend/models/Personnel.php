<?php

namespace app\models;


/**
 * This is the model class for table "personnel".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $name
 * @property string $phone
 * @property integer $id_position
 * @property integer $action
 *
 * @property Position $idPosition
 */
class Personnel extends \yii\db\ActiveRecord
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
            [['last_name', 'name', 'phone', 'id_position', 'action'], 'required'],
            [['id_position', 'action'], 'integer'],
            [['last_name', 'name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 15],
            [['id_position'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['id_position' => 'id']],
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
            'id_position' => 'Id Position',
            'action' => 'Action',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPosition()
    {
        return $this->hasOne(Position::className(), ['id' => 'id_position']);
    }
}
