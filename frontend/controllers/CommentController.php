<?php

namespace frontend\controllers;

use app\models\Comment;
use app\models\Helpdesk;
use app\models\Todoist;
use app\models\User;
use frontend\models\Telegram;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class CommentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
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


    /**
     * Save comment who came todoist
     * if success redirected [todoist/index]
     * @param $id
     * @return \yii\web\Response
     */
    public function actionTodoist($id)
    {
        $commentForm = new Comment();
        $telegram = new Telegram();
        $todoist = Todoist::findOne($id);
        $user = Yii::$app->user->id;

        if ($commentForm->load(Yii::$app->request->post())){
            $commentForm->id_todoist = $id;
            $commentForm->id_user = Yii::$app->user->id;
            if (!$commentForm->save()){
                print_r($commentForm->getErrors());
            } else {
                if ($todoist->id_sotrud_put != $user){
                    $telegram->message($todoist->id_sotrud_put, 'Задачу '.$commentForm->idTodoist->comment.' прокомментировали '.$commentForm->comment);
                } elseif($todoist->id_user != $user){
                    $telegram->message($todoist->id_user, 'Задачу '.$commentForm->idTodoist->comment.' прокомментировали '.$commentForm->comment);
                }
                if (Yii::$app->user->can('admin')){
                    return $this->redirect(['todoist/index']);
                } else {
                    return $this->redirect(['todoist/shop']);
                }
            };
        }
    }

    public function actionHelpdesk($id)
    {
        $commentForm = new Comment();
        $telegram = new Telegram();
        $helpdesk = Helpdesk::findOne($id);

        if ($commentForm->load(Yii::$app->request->post())){
            $commentForm->id_helpdesk = $id;
            $commentForm->id_user = Yii::$app->user->id;
            if (!$commentForm->save()){
                print_r($commentForm->getErrors());
            } else {
                if(Yii::$app->user->id != User::USER_SYSTEM){
                    $telegram->message($helpdesk->id_user, 'Поломку '.$commentForm->idHelpdesk->commetnt.' прокомментировали '.$commentForm->comment);
                } else {
                    $telegram->message(User::USER_SYSTEM, 'Поломку '.$commentForm->idHelpdesk->commetnt.' прокомментировали '.$commentForm->comment);
                }
                return $this->redirect(['helpdesk/index']);
            };
        }
    }

    /**
     * Save comment
     * @return bool
     */
    public function actionZakaz()
    {
        $comment = new Comment();

        if($comment->load(Yii::$app->request->post()) && $comment->validate()){
            if($comment->save()){
                return true;
            } else {
                return false;
            }
        }
    }

}
