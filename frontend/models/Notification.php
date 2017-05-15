<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $name
 * @property integer $id_zakaz
 * @property integer $category
 * @property integer $active
 *
 * @property Zakaz $idZakaz
 * @property User $idUser
 */
class Notification extends \yii\db\ActiveRecord
{
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
            [['id_user', 'category','active'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'id_user' => 'Id User',
            'name' => 'Name',
            'id_zakaz' => 'Id Zakaz',
            'category' => 'Category',
            'active' => 'Active',
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
    public function getSaveNotification()
    {
        $this->active = true;
        $this->save();
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
}
