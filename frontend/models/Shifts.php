<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shifts".
 *
 * @property integer $id
 * @property string $start
 * @property string $end
 * @property integer $id_sotrud
 *
 * @property Personnel $idSotrud
 */
class Shifts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shifts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end'], 'safe'],
            [['end', 'id_sotrud'], 'required'],
            [['id_sotrud'], 'integer'],
            [['id_sotrud'], 'exist', 'skipOnError' => true, 'targetClass' => Personnel::className(), 'targetAttribute' => ['id_sotrud' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start' => 'Start',
            'end' => 'End',
            'id_sotrud' => 'Id Sotrud',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSotrud()
    {
        return $this->hasOne(Personnel::className(), ['id' => 'id_sotrud']);
    }
}
