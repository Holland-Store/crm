<?php

namespace app\models;

/**
 * This is the model class for table "financy".
 *
 * @property integer $id
 * @property string $date
 * @property integer $sum
 * @property integer $id_zakaz
 * @property integer $id_user
 *
 * @property User $idUser
 * @property Zakaz $idZakaz
 */
class Financy extends \yii\db\ActiveRecord
{
    public $amount;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'financy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sum'], 'required'],
            [['id', 'id_zakaz', 'id_user'], 'integer'],
            [['date'], 'safe'],
            ['sum', 'filter', 'filter' => function($value){
                return str_replace(' ', '', $value);
            }],
            ['sum', 'compare', 'compareValue' => $this->amount, 'operator' => '<=', 'type' => 'number'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_zakaz'], 'exist', 'skipOnError' => true, 'targetClass' => Zakaz::className(), 'targetAttribute' => ['id_zakaz' => 'id_zakaz']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'sum' => 'Сумма',
            'id_zakaz' => 'Id Zakaz',
            'id_user' => 'Id User',
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
    public function getIdZakaz()
    {
        return $this->hasOne(Zakaz::className(), ['id_zakaz' => 'id_zakaz']);
    }

    /**
     * Create zakaz save fact_oplata Zakaz models
     * @param $sum
     * @param $id
     * @param $oplata
     */
    public function saveSum($sum, $id, $oplata)
    {
        $this->amount = $oplata;
        $this->sum = $sum;
        $this->id_zakaz = $id;
        $this->id_user = \Yii::$app->user->id;
        if (!$this->sum == 0 or !$this->sum == null){
            $this->save();
        }
    }
}
