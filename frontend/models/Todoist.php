<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "todoist".
 *
 * @property integer $id
 * @property string $date
 * @property string $srok
 * @property integer $id_zakaz
 * @property integer $id_user
 * @property integer $id_sotrud_put
 * @property string $comment
 * @property integer $activate
 *
 * @property Zakaz $idZakaz
 * @property User $idUser
 * @property User $idSotrudPut
 */
class Todoist extends ActiveRecord
{
	const MOSCOW = 2;
	const PUSHKIN = 6;
	const SIBIR = 9;
	const ZAKUP = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'todoist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['srok', 'comment'], 'required'],
            [['srok', 'date'], 'safe'],
            [['id_zakaz', 'id_user', 'id_sotrud_put','activate'], 'integer'],
            [['comment'], 'string'],
            [['id_sotrud_put'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_sotrud_put' => 'id']],
            [['id_zakaz'], 'exist', 'skipOnError' => true, 'targetClass' => Zakaz::className(), 'targetAttribute' => ['id_zakaz' => 'id_zakaz']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'srok' => 'Срок',
            'id_zakaz' => 'Заказ',
            'id_user' => 'Назначение',
            'id_sotrud_put' => 'Сотрудник поставил',
            'comment' => 'Доп.указание',
            'activate' => 'Статус',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdZakaz()
    {
        return $this->hasOne(Zakaz::className(), ['id_zakaz' => 'id_zakaz']);
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
    public function getIdSotrudPut()
    {
        return $this->hasOne(User::className(), ['id' => 'id_sotrud_put']);
    }

	public static function getIdUserArray()
	{
		return [
			self::MOSCOW => 'Московский',
			self::PUSHKIN => 'Пушкина',
			self::SIBIR => 'Сибирский',
			self::ZAKUP => 'Закупки',
		];
	}
	public function getIdUserName()
	{
		return ArrayHelper::getValue(self::getIdUser(), $this->id_user);
	}
    public static function getTodoistArray()
    {
        return [
            '0' => 'Активный',
            '1' => 'Выполнен',
        ];
    }
    public function getTodoistName()
    {
        return ArrayHelper::getValue(self::getTodoistArray(), $this->activate);
    }

    public function beforeSave($insert)
    {
        $this->srok = date('Y-m-d', strtotime($this->srok));
        return parent::beforeSave($insert);
    }
}
