<?php

namespace app\models;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "Comment".
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $sotrud
 * @property integer $id_zakaz
 * @property string $date
 * @property string $comment
 *
 * @property User $idUser
 * @property User $sotrud0
 * @property Zakaz $idZakaz
 */
class Comment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_zakaz'], 'required'],
            [['id_user', 'sotrud', 'id_zakaz'], 'integer'],
            [['date'], 'safe'],
            [['comment'], 'string'],
            [['id_zakaz'], 'exist', 'skipOnError' => true, 'targetClass' => Zakaz::className(), 'targetAttribute' => ['id_zakaz' => 'id_zakaz']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['sotrud'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sotrud' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'sotrud' => 'Sotrud',
            'id_zakaz' => 'Id Zakaz',
            'date' => 'Date',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSotrud0()
    {
        return $this->hasOne(User::className(), ['id' => 'sotrud']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdZakaz()
    {
        return $this->hasOne(Zakaz::className(), ['id_zakaz' => 'id_zakaz']);
    }
}
