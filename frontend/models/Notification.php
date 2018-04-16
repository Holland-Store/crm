<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Todoist;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $name
 * @property integer $id_zakaz
 * @property integer $todoist_id
 * @property integer $category
 * @property string $srok
 * @property integer $active
 *
 * @property Todoist $todoist
 * @property Zakaz $idZakaz
 * @property User $idUser
 */
class Notification extends ActiveRecord
{
    const ACTIVE = 1;
    const NOT_ACTIVE = 0;

    const CATEGORY_SHIPPING = 0;
    const CATEGORY_SUCCESS = 1;
    const CATEGORY_NEW = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'category','todoist_id','active'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['srok'], 'safe'],
            [['id_zakaz'], 'exist', 'skipOnError' => true, 'targetClass' => Zakaz::className(), 'targetAttribute' => ['id_zakaz' => 'id_zakaz']],
            [['todoist_id'], 'exist', 'skipOnError' => true, 'targetClass' => Todoist::className(), 'targetAttribute' => ['todoist_id' => 'id']],
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
            'id_user' => 'Id User',
            'name' => 'Name',
            'id_zakaz' => 'Id Zakaz',
            'todoist_id' => 'Todoist ID',
            'category' => 'Category',
            'srok' => 'Напоминание',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getTodoist()
    {
        return $this->hasOne(Todoist::className(), ['id' => 'todoist_id']);
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
    public function getSaveNotification()
    {
		$this->srok = null;
        $this->active = true;
        $this->save();
        if (!$this->save()) {
            print_r($this->getErrors());
        }
    }
    public static function getCategoryArray()
    {
        return [
            self::CATEGORY_SHIPPING => 'Доставка',
            self::CATEGORY_SUCCESS => 'Выполнена работа',
            self::CATEGORY_NEW => 'Новый заказ',
        ];
    }
    public function getCategoryName()
    {
        return ArrayHelper::getValue(self::getCategoryArray(), $this->category);
    }

    public function getByIdNotification($id, $zakaz)
    {
        switch ($id) {
            case '2'://оформление уведомление администратору о назначение заказа
                $this->id_user = User::USER_ADMIN;
                $this->name = 'Магазин создал новый заказ №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 2;
                break;
            case '3'://оформление уведомление мастеру
                $this->id_user = $id;
                $this->name = 'Новый заказ №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 2;
                break;
            case '4'://оформление уведомление дизайнеру
                $this->id_user = $id;
                $this->name = 'Новый заказ №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 2;
                break;
            case '5'://оформление уведомление выполение работы дизайнера
                $this->id_user = $id;
                $this->name = 'Дизайнер выполнил работу №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 1;
                break;
            case '6'://оформление уведомление выполение работы курьера
                $this->id_user = $id;
                $this->name = 'Курьер забрал заказ №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 1;
                break;
            case '7'://оформление уведомление доставки
                $this->id_user = $id;
                $this->name = 'Новая доставка №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 2;
                break;
            case '8'://Уведомление, что мастер выполнил работу
                $this->id_user = 5;
                $this->name = 'Мастер выполнил работу №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 1;
                break;
            case '9'://оформление уведомление курьер забрал заказ
                $this->id_user = $id;
                $this->name = 'Курьер доставил заказ №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 1;
                break;
            case '10'://Уведомление, администратору что магазин закрыл заказ
                $this->id_user = 5;
                $this->name = 'Магазин закрыл заказ №'.$zakaz;
                $this->id_zakaz = $zakaz;
                $this->category = 1;
                break;
        }
    }

    public function getByIdNotificationTodoList($id, $todoist)
    {
        switch ($id) {
            case 'create'://оформление уведомление исполнителю
                $this->id_user = $todoist->id_user;
                $this->name = 'Новая задача '.$todoist->comment;
                $this->todoist_id = $todoist->id;
                $this->category = 2;
                break;
            case 'ready'://оформление уведомление заказчика
                $this->id_user = $todoist->id_sotrud_put;
                $this->name = 'Выполнена задача '.$todoist->comment;
                $this->todoist_id = $todoist->id;
                $this->category = 2;
                break;
        }
    }

    public function getByIdNotificationComments($id, $comment, $id_sotrud_put)
    {
        switch ($id) {
            case '1'://оформление уведомление о новом комментарии к созданной задача
                $this->id_user = $id_sotrud_put;
                $this->name = substr('Комментарий к созданной задаче '.$comment->comment, 0, 49) . '...' ;
                $this->todoist_id = $comment->id_todoist;
                $this->category = 2;
                break;
            case '2'://оформление уведомление о новом ответе к выполняемой задачи
                $this->id_user = $comment->id_user;
                $this->name = substr('Добавлен ответ к выполняемой задачи '.$comment->comment, 0, 49) . '...' ;
                $this->todoist_id = $comment->id_todoist;
                $this->category = 2;
                break;
            case '3'://оформление уведомление для сотрудника с проблемой
                $this->id_user = $comment->id_user;
                $this->name = substr('Комит к проблеме '.$comment->comment, 0, 49) . '...' ;
                $this->todoist_id = $comment->id_todoist;
                $this->category = 2;
                break;
            case '4'://оформление уведомление helpdesk
                $this->id_user = User::USER_SYSTEM ;
                $this->name = substr('Коммит от сотрудника по ошибке'.$comment->comment, 0, 49) . '...' ;
                $this->todoist_id = $comment->id_todoist;
                $this->category = 2;
                break;
        }
    }

    public function getReminder($id)
    {
        $this->id_user = 5;
        $this->name = 'Создана напоминание';
        $this->id_zakaz = $id;
        $this->category = 4;
        $this->active = true;
    }

    public function getCreateNotice($user, $order_id)
    {
        $this->id_user = $user;
        $this->name = 'Были правки в заказе '.$order_id;
        $this->active = self::ACTIVE;
        $this->id_zakaz = $order_id;
    }
}
