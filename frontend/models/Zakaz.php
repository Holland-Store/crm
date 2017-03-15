<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zakaz".
 *
 * @property integer $id_zakaz
 * @property string $srok
 * @property integer $id_sotrud
 * @property string $prioritet
 * @property string $status
 * @property integer $id_tovar
 * @property integer $oplata
 * @property integer $number
 * @property string $data
 * @property string $description
 * @property string $information
 * @property integer $id_client
 * @property string $comment
 *
 * @property Otdel $idSotrud
 * @property Tovar $idTovar
 * @property Client $idClient
 */
class Zakaz extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zakaz';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_zakaz', 'srok', 'id_sotrud', 'prioritet', 'status', 'id_tovar', 'oplata', 'number', 'data', 'description', 'information', 'id_client', 'comment'], 'required'],
            [['id_zakaz', 'id_sotrud', 'id_tovar', 'oplata', 'number', 'id_client'], 'integer'],
            [['srok', 'data'], 'safe'],
            [['comment'], 'string'],
            [['prioritet', 'status'], 'string', 'max' => 36],
            [['description', 'information'], 'string', 'max' => 500],
            [['id_sotrud'], 'exist', 'skipOnError' => true, 'targetClass' => Otdel::className(), 'targetAttribute' => ['id_sotrud' => 'id_sotr']],
            [['id_tovar'], 'exist', 'skipOnError' => true, 'targetClass' => Tovar::className(), 'targetAttribute' => ['id_tovar' => 'id']],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['id_client' => 'id_client']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_zakaz' => '№ заказа',
            'srok' => 'Срок',
            'id_sotrud' => 'Сотрудник',
            'prioritet' => 'Приоритет',
            'status' => 'Статус',
            'id_tovar' => 'Товар',
            'oplata' => 'Сумма',
            'number' => 'Количество',
            'data' => 'Дата принятия',
            'description' => 'Описание',
            'information' => 'Дополнительная информация',
            'id_client' => 'Клиент',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSotrud()
    {
        return $this->hasOne(Otdel::className(), ['id' => 'id_sotrud']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTovar()
    {
        return $this->hasOne(Tovar::className(), ['id' => 'id_tovar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(Client::className(), ['id_client' => 'id_client']);
    }
}
