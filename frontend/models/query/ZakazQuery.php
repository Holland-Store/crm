<?php

namespace app\models\query;

use app\models\Zakaz;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Zakaz]].
 *
 * @see Zakaz
 */
class ZakazQuery extends ActiveQuery
{
    public function masterGridView()
    {
        return $this->andWhere(['status' => [
            Zakaz::STATUS_MASTER,
            Zakaz::STATUS_DECLINED_MASTER
        ], 'action' => 1]);
    }

    public function admin()
    {
        return $this->andWhere(['status' => [
            Zakaz::STATUS_DISAIN,
            Zakaz::STATUS_MASTER,
            Zakaz::STATUS_AUTSORS,
            Zakaz::STATUS_SUC_MASTER,
            Zakaz::STATUS_SUC_DISAIN,
            Zakaz::STATUS_DECLINED_DISAIN,
            Zakaz::STATUS_DECLINED_MASTER
        ], 'action' => 1]);
    }

    public function masterAgreed()
    {
        return $this->andWhere(['status' => Zakaz::STATUS_SUC_MASTER, 'action' => 1]);
    }

    public function disainerGridView()
    {
        return $this->andWhere([
        'status' => [
            Zakaz::STATUS_DISAIN,
            Zakaz::STATUS_DECLINED_DISAIN
        ],
        'statusDisain' => [
            Zakaz::STATUS_DISAINER_NEW,
            Zakaz::STATUS_DISAINER_WORK,
            Zakaz::STATUS_DISAINER_DECLINED
        ],
        'action' => 1]);
    }

    public function disainAgreed()
    {
        return $this->andWhere([
                'status' => Zakaz::STATUS_DISAIN,
                'statusDisain' => Zakaz::STATUS_DISAINER_SOGLAS,
                'action' => 1
            ])
            ->orWhere(['status' => Zakaz::STATUS_SUC_DISAIN, 'action' => 1]);
    }

    public function shopWorkGridView()
    {
        return $this->andWhere([
            'id_sotrud' => Yii::$app->user->id,
            'action' => 1,
            'status' => [
                Zakaz::STATUS_DISAIN,
                Zakaz::STATUS_MASTER,
                Zakaz::STATUS_AUTSORS,
                Zakaz::STATUS_SUC_MASTER,
                Zakaz::STATUS_SUC_DISAIN,
                Zakaz::STATUS_DECLINED_DISAIN,
                Zakaz::STATUS_DECLINED_MASTER,
                Zakaz::STATUS_NEW,
                Zakaz::STATUS_ADOPTED
            ]
        ]);
    }

    public function shopExecute()
    {
        return $this->andWhere(['id_shop' => Yii::$app->user->id, 'action' => 1, 'status' => Zakaz::STATUS_EXECUTE]);
    }

    public function adminWork()
    {
        return $this->andWhere(['status' => [
            Zakaz::STATUS_NEW,
            Zakaz::STATUS_ADOPTED,
            Zakaz::STATUS_REJECT
        ], 'action' => 1]);
    }

    public function adminFulfiled()
    {
        return $this->andWhere(['status' => Zakaz::STATUS_EXECUTE, 'action' => 1]);
    }

    public function managerGridView()
    {
        return $this->andWhere(['<', 'srok', date('Y-m-d H:i:s')])
            ->andWhere(['>', 'oplata', 1000])
            ->andWhere(['action' => 1]);
    }

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
