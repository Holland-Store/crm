<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Tovar;
use app\models\Client;
use yii\db\ActiveRecord;

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
class Zakaz extends ActiveRecord
{

    const STATUS_NEW = 0;
    const STATUS_WORK = 1;
    const STATUS_EXECUTE = 2;
    const STATUS_APOTED = 3;
    const STATUS_DISAIN = 4;
    const STATUS_REJECT_DISAIN = 5;
    const STATUS_MASTER = 6;
    const STATUS_AUTSORS = 7;
    const STATUS_CLOSE = 8;

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
            [['srok', 'minut', 'oplata', 'number', 'data', 'description','name', 'phone'], 'required'],
            [['id_zakaz', 'id_tovar', 'oplata', 'fact_oplata', 'number', 'status'], 'integer'],
            [['srok', 'minut', 'data', 'phone'], 'safe'],
            [['comment'], 'string'],
            ['id_sotrud', 'default', 'value'=>Yii::$app->user->id],
            [['prioritet'], 'string', 'max' => 36],

            ['status', 'default', 'value' => self::STATUS_NEW],
            // ['status', 'in', 'range' => array_keys(self::getStatusName())],

            [['description', 'information'], 'string', 'max' => 500],
            [['img', 'email', 'phone', 'name'],'string', 'max' => 50],
            [['id_sotrud'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_sotrud' => 'id']],
            [['id_tovar'], 'exist', 'skipOnError' => true, 'targetClass' => Tovar::className(), 'targetAttribute' => ['id_tovar' => 'id']],
            // [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['id_client' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_zakaz' => '№',
            'srok' => 'Срок',
            'minut' => 'Время',
            'id_sotrud' => 'Магазин',
            'prioritet' => 'Приоритет',
            'status' => 'Этап',
            'id_tovar' => 'Категория',
            'oplata' => 'Всего',
            'fact_oplata' => 'Оплачено',
            'number' => 'Количество',
            'data' => 'Дата принятия',
            'description' => 'Описание',
            'img' => 'Изображение',
            'information' => 'Дополнительная информация',
            'name' => 'Клиент',
            'phone' => 'Телефон',
            'email' => 'Email',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSotrud()
    {
        return $this->hasOne(User::className(), ['id' => 'id_sotrud']);
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

    public static function getSotrudList()
    {
        $sotruds = Otdel::find()
        ->select(['otdel.id','otdel.fio'])
        ->join('JOIN','zakaz', 'zakaz.id_sotrud = otdel.id')
        ->all();

        return ArrayHelper::map($sotruds, 'id', 'fio');
    }
    public static function getTovarList()
    {
        $tovars = Tovar::find()
        ->select(['tovar.id','tovar.name'])
        ->join('JOIN','zakaz', 'zakaz.id_tovar = tovar.id')
        ->all();

        return ArrayHelper::map($tovars, 'id', 'name');
    }
    // public static function getClientList()
    // {
    //     $tovars = Client::find()
    //     ->select(['client.id','client.fio'])
    //     ->join('JOIN','zakaz', 'zakaz.id_client = client.id')
    //     ->all();

    //     return ArrayHelper::map($tovars, 'id', 'fio');
    // }
    public static function getStatusArray(){
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_WORK => 'В работе',
            self::STATUS_EXECUTE => 'Исполнен',
            self::STATUS_APOTED => 'Принят',
            self::STATUS_DISAIN => 'Дизайнер',
            self::STATUS_REJECT_DISAIN => 'Отклонен дизайнером',
            self::STATUS_MASTER => 'Мастер',
            self::STATUS_AUTSORS => 'Аутсорс',
            self::STATUS_CLOSE => 'Закрыт',
        ];
    }
    public function getStatusName(){
        return ArrayHelper::getValue(self::getStatusArray(), $this->status);
    }
}
