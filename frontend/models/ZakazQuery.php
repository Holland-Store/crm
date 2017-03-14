<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Zakaz]].
 *
 * @see Zakaz
 */
class ZakazQuery extends \yii\db\ActiveQuery
{
    $zakaz = Zakaz::find()
    ->select('zakaz.*')
    ->leftJoin('otdel', '`zakaz`.`id_sotrud` = `otdel`.`id`')
    ->all();
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Zakaz[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Zakaz|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
