<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "zakaz".
 *
 * @property integer $id_zakaz
 * @property string $srok
 * @property integer $minut
 * @property integer $id_sotrud
 * @property string $sotrud_name
 * @property integer $prioritet
 * @property integer $status
 * @property integer $action
 * @property integer $id_tovar
 * @property integer $oplata
 * @property integer $fact_oplata
 * @property integer $number
 * @property string $data
 * @property string $description
 * @property string $information
 * @property string $img
 * @property string $maket
 * @property integer $time
 * @property integer $statusDisain
 * @property integer $statusMaster
 * @property string $data_start_disain
 * @property string $name
 * @property integer $phone
 * @property string $email
 * @property integer $id_client,
 * @property string $comment
 * @property integer $id_shipping
 * @property string $declined
 * @property integer $id_unread
 *
 * @property Comment[] $comments
 * @property Courier[] $couriers
 * @property Notification[] $notifications
 * @property Todoist[] $todoists
 * @property Client $idClient
 * @property Tovar $idTovar
 * @property User $idSotrud
 * @property Courier $idShipping
 *
 */
class Zakaz extends ActiveRecord
{
    public $file;
    public $search;

    const STATUS_NEW = 0;
    const STATUS_EXECUTE = 1;
    const STATUS_ADOPTED = 2;
    const STATUS_DISAIN = 3;
    const STATUS_SUC_DISAIN = 4;
    const STATUS_REJECT = 5;
    const STATUS_MASTER = 6;
    const STATUS_SUC_MASTER = 7;
    const STATUS_AUTSORS = 8;
    const STATUS_DECLINED_DISAIN = 9;
    const STATUS_DECLINED_MASTER = 10;

    const STATUS_DISAINER_NEW = 0;
    const STATUS_DISAINER_WORK = 1;
    const STATUS_DISAINER_SOGLAS = 2;
    const STATUS_DISAINER_PROCESS = 3;
    const STATUS_DISAINER_DECLINED = 4;

    const STATUS_MASTER_NEW = 0;
    const STATUS_MASTER_WORK = 1;
    const STATUS_MASTER_PROCESS = 2;
    const STATUS_MASTER_DECLINED = 3;

    const SCENARIO_DECLINED = 'declined';
    const SCENARIO_DEFAULT  = 'default';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zakaz';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DECLINED => ['declined', 'required'],
            self::SCENARIO_DEFAULT => ['srok', 'number', 'description', 'phone', 'id_sotrud','sotrud_name', 'status', 'id_tovar', 'oplata', 'fact_oplata', 'number', 'statusDisain', 'statusMaster', 'img', 'id_shipping', 'id_tovar', 'id_unread', 'information', 'data', 'prioritet', 'phone', 'email', 'name', 'maket', 'time'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['srok', 'number', 'description', 'phone', 'id_client'], 'required', 'on' => self::SCENARIO_DEFAULT],
            ['declined', 'required', 'message' => 'Введите причину отказа', 'on'=> self::SCENARIO_DECLINED],
            [['id_zakaz', 'id_tovar', 'oplata', 'fact_oplata', 'minut', 'time', 'number', 'status', 'action', 'id_sotrud', 'phone', 'id_client','id_shipping' ,'prioritet', 'statusDisain', 'statusMaster', 'id_unread'], 'integer'],
            [['srok', 'data', 'data-start-disain'], 'safe'],
            [['information', 'comment', 'search', 'declined'], 'string'],
            ['prioritet', 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_NEW],
            ['id_sotrud', 'default', 'value' => Yii::$app->user->getId()],
            ['data', 'default', 'value' => date('Y-m-d H:i:s')],
            [['description'], 'string', 'max' => 500],
            [['email', 'name', 'img', 'maket', 'sotrud_name'],'string', 'max' => 50],
            [['file'], 'file', 'skipOnEmpty' => true],
            [['id_sotrud'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_sotrud' => 'id']],
            [['id_tovar'], 'exist', 'skipOnError' => true, 'targetClass' => Tovar::className(), 'targetAttribute' => ['id_tovar' => 'id']],
            [['id_shipping'], 'exist', 'skipOnError' => true, 'targetClass' => Courier::className(), 'targetAttribute' => ['id_shipping' => 'id']],
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
            'minut' => 'Часы',
            'id_sotrud' => 'Магазин',
            'sotrud_name' => 'Сотрудник',
            'prioritet' => 'Приоритет',
            'status' => 'Этап',
            'id_tovar' => 'Категория',
            'oplata' => 'Всего',
            'fact_oplata' => 'Оплачено',
            'number' => 'Количество',
            'data' => 'Дата принятия',
            'description' => 'Описание',
            'img' => 'Приложение',
            'time' => 'Рекомендуемое время',
            'maket' => 'Макет дизайнера',
            'statusDisain' => 'Этап',
            'statusMaster' => 'Этап',
            'data_start_disain' => 'Дата начала',
            'file' => 'Файл',
            'information' => 'Дополнительная информация',
            'name' => 'Клиент',
            'phone' => 'Телефон',
            'email' => 'Email',
            'id_client' => '№ клиента',
            'comment' => 'Комментарий',
            'id_shipping' => 'Доставка',
            'declined' => 'Причина отказа',
            'id_unread' => 'Id unread',
            'search' => 'Search',
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
    public function getIdShipping()
    {
        return $this->hasOne(Courier::className(), ['id' => 'id_shipping']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'id_client']);
    }

//    /**
//     * @return \yii\db\ActiveQuery
//     */
//
//    public static function getSotrudList()
//    {
//        $sotruds = Otdel::find()
//        ->select(['otdel.id','otdel.fio'])
//        ->join('JOIN','zakaz', 'zakaz.id_sotrud = otdel.id')
//        ->all();
//
////        return ArrayHelper::map($sotruds, 'id', 'fio');
//    }

    /**
     * @return array
     */
    public static function getStatusArray(){
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_EXECUTE => 'Исполнен',
            self::STATUS_ADOPTED => 'Принят',
            self::STATUS_DISAIN => 'Дизайнер',
            self::STATUS_SUC_DISAIN => 'Дизайнер',
            self::STATUS_DECLINED_DISAIN => 'Дизайнер',
            self::STATUS_REJECT => 'Отклонен',
            self::STATUS_MASTER => 'Мастер',
            self::STATUS_SUC_MASTER => 'Мастер',
            self::STATUS_DECLINED_MASTER => 'Мастер',
            self::STATUS_AUTSORS => 'Аутсорс',
        ];
    }

    /**
     * @return mixed
     */
    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusArray(), $this->status);
    }
    public static function getPrioritetArray()
    {
        return [
            '0' => '',
            '1' => 'важно',
            '2' => 'очень важно',
        ];
    }

    /**
     * @return mixed
     */
    public function getPrioritetName()
    {
        return ArrayHelper::getValue(self::getPrioritetArray(), $this->prioritet);
    }

    /**
     * @return array
     */
    public static function getStatusDisainArray()
    {
        return [
            self::STATUS_DISAINER_NEW => 'Новый',
            self::STATUS_DISAINER_WORK => 'В работе',
            self::STATUS_DISAINER_SOGLAS => 'Согласование',
            self::STATUS_DISAINER_PROCESS => 'На проверке',
            self::STATUS_DISAINER_DECLINED => 'Отлонен',
        ];
    }

    /**
     * @return mixed
     */
    public function getStatusDisainName()
    {
        return ArrayHelper::getValue(self::getStatusDisainArray(), $this->statusDisain);
    }

    /**
     * @return array
     */
    public static function getStatusMasterArray()
    {
        return [
            self::STATUS_MASTER_NEW => 'Новый',
            self::STATUS_MASTER_WORK => 'В работе',
            self::STATUS_MASTER_PROCESS => 'На проверке',
            self::STATUS_MASTER_DECLINED => 'Отклонен',
        ];
    }

    /**
     * @return mixed
     */
    public function getStatusMasterName()
    {
        return ArrayHelper::getValue(self::getStatusMasterArray(), $this->statusMaster);
    }

    /**
     * Upload file for page 'create' and 'update'
     * @return bool
     */
    public function upload()
    {
        if($this->validate()){
            $this->file->saveAs('attachment/'.time().'.'.$this->file->extension);
        return true;
        } else {return false;}
    }
    public static function getPreficsList()
    {
        return [
            '2' => 'M',
            '6' => 'P',
            '8' => 'T',
            '9' => 'S',
        ];
    }

    /**
     * Creates a prefics at the beginning id_zakaz
     * @return int|string
     */
    public function getPrefics()
    {
        $list = self::getPreficsList();
        return (isset($list[$this->id_sotrud])) ? $list[$this->id_sotrud].'-'.$this->id_zakaz :         $this->id_zakaz;
    }

    /**
     * Upload the layout from the designer
     * @return bool
     */
    public function getUploadeFile()
    {
        //Выполнена работа дизайнером
        if($this->validate())
        {
            $this->file->saveAs('maket/Maket_'.$this->id_zakaz.'.'.$this->file->extension);
            $this->maket = 'Maket_'.$this->id_zakaz.'.'.$this->file->extension;
            $this->status = 4;
            return true;
        } else {
            return false;
        }
    }
}
