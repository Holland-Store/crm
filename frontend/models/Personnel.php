<?php

namespace app\models;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "personnel".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $name
 * @property string $nameSotrud
 * @property string $phone
 * @property integer $action
 * @property string $job_duties
 *
 */
class Personnel extends \yii\db\ActiveRecord
{
    const WORK = 0;
    const DISMISSAL = 1;
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
            [['action'], 'integer'],
            [['last_name', 'name'], 'string', 'max' => 50],
            [['job_duties'], 'string', 'max' => 86],
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
            'last_name' => 'Фамилия',
            'name' => 'Имя',
            'nameSotrud' => 'Фамилия и имя',
            'phone' => 'Телефон',
            'action' => 'Action',
            'job_duties' => 'Должностные обязанности',
            'positions' => 'Должность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonnelPosition()
    {
        return $this->hasMany(PersonnelPosition::className(), ['personnel_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Position::className(), ['id' => 'position_id'])->via('personnelPosition');
    }

    /**
     * @return string
     */
    public function getNameSotrud()
    {
        return $this->last_name.' '.$this->name;
    }

    /**
     * @return string
     */
    public function getPositionsAsString()
    {
        $arr = ArrayHelper::map($this->positions, 'id', 'name');
        return implode(', ', $arr);
    }
}
