<?php

namespace app\models;

/**
 * This is the model class for table "guide".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property string $standarts
 * @property string $title
 * @property integer $created_at
 * @property integer $updated_at
 */
class Guide extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guide';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answer', 'standarts', 'title', 'created_at', 'updated_at'], 'required'],
            [['question', 'answer', 'standarts'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 86],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Вопросы',
            'answer' => 'Ответы',
            'standarts' => 'Стандарты',
            'title' => 'Заголовок',
            'created_at' => 'Создан',
            'updated_at' => 'Редактирован',
        ];
    }
}
