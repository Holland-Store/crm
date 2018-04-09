<?php

namespace frontend\controllers;

use Yii;
use app\models\Notification;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
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
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['ready'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['read-notice'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Notification::find()->where(['id_user' => Yii::$app->user->id])->limit(50)->all();

        return $this->render('index', [
                'model' => $model,
            ]);
    }


    /**
     *  Read all an existing Notification model.
     * If ready is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionReady($id)
    {
        $model = $this->findModel(['id_user' => $id]);
        $model->getDb()->createCommand()->update('notification', ['active' => 0], ['id_user' => $id])->execute();

        return $this->redirect(['index']);


        // return $this->render('ready');
    }
    /**
     *  One notification an existing Notification model.
     * If ready is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionReadNotice($id)
    {
        $model = $this->findModel(['id_zakaz' => $id]);
        $model->active = Notification::NOT_ACTIVE;
        $model->save();
        return $this->redirect(['zakaz/admin', '#' => $id]);
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }    
    protected function findNotification()
    {
        $notification = Notification::find()->where(['id_user' => Yii::$app->user->id, 'active' => true]);
        if($notification->count()>50){
                $notifications = '50+';
            } elseif ($notification->count()<1){
                $notifications = '';
            } else {
                $notifications = $notification->count();
            }

        $this->view->params['notifications'] = $notification->all();
        $this->view->params['count'] =  $notifications;
    }
}
