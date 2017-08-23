<?php

namespace app\models;


/**
 * This is the model class for table "zakaz_tag".
 *
 * @property integer $id
 * @property integer $zakaz_id
 * @property integer $tag_id
 */
class ZakazTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zakaz_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zakaz_id', 'tag_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'zakaz_id' => 'Zakaz ID',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
