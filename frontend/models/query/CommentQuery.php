<?php

namespace app\models\query;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\Comment]].
 *
 * @see \app\models\Comment
 */
class CommentQuery extends ActiveQuery
{
    public function todoist($id)
    {
        return $this->select(['date', 'comment', 'id_user'])
            ->with(['idUser'])
            ->where(['id_todoist' => $id])
            ->orderBy('id DESC')
            ->limit(3)
            ->all();
    }

    /**
     * @inheritdoc
     * @return \app\models\Comment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\Comment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
