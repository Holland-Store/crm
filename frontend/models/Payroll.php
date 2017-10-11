<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payroll".
 *
 * @property integer $id
 * @property integer $personnel_id
 * @property string $date
 */
class Payroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payroll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['personnel_id'], 'required'],
            [['personnel_id'], 'integer'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'personnel_id' => 'Personnel ID',
            'date' => 'Date',
        ];
    }
}
