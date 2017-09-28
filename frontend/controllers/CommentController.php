<?php

namespace frontend\controllers;

use app\models\Comment;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['todoist'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    public function actionTodoist($id)
    {
        $commentForm = new Comment();

        if ($commentForm->load(Yii::$app->request->post())){
            $commentForm->id_todoist = $id;
            $commentForm->id_user = Yii::$app->user->id;
            if (!$commentForm->save()){
                print_r($commentForm->getErrors());
            } else {
                $this->redirect(['todoist/index']);
            };
        }
    }

}
