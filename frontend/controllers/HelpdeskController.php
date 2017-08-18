<?php

namespace frontend\controllers;

use app\models\User;
use app\models\Zakaz;
use Yii;
use app\models\Helpdesk;
use app\models\HelpdeskSearch;
use app\models\Notification;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * HelpdeskController implements the CRUD actions for Helpdesk model.
 */
class HelpdeskController extends Controller
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
    					'roles' => ['admin', 'disain', 'master', 'system', 'zakup', 'shop'],
					],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['admin', 'disain', 'master', 'zakup', 'shop'],
                    ],
					[
						'actions' => ['close'],
						'allow' => true,
						'roles' => ['system'],
					],
                    [
						'actions' => ['approved'],
						'allow' => true,
						'roles' => ['admin', 'disain', 'master', 'zakup', 'shop'],
					],
                    [
						'actions' => ['declined-help'],
						'allow' => true,
						'roles' => ['admin', 'disain', 'master', 'zakup', 'shop'],
					]
				]
			]
        ];
    }

    /**
     * Lists all Helpdesk models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HelpdeskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'work');
        $dataProviderSoglas = $searchModel->search(Yii::$app->request->queryParams, 'soglas');
        $notification = $this->findNotification();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderSoglas' => $dataProviderSoglas,
            'notification' => $notification,
        ]);
    }

    /**
     * Displays a single Helpdesk model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $notification = $this->findNotification();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'notification' => $notification,
        ]);
    }

    /**
     * Creates a new Helpdesk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Helpdesk();
        $user = User::findOne(['id' => User::USER_SYSTEM]);
        $notification = $this->findNotification();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()){
                try{
                    Yii::$app->session->addFlash('update', 'Заявка успешно создана');
                    Yii::$app->bot->sendMessage($user->telegram_chat_id, 'Назначена заявка на поломку '.$model->commetnt);
                    return $this->redirect(['index', 'id' => $model->id]);
                }catch (Exception $e){
                    $e->getMessage();
                };
            } else {
                $this->flashErrors();
            }
        }
        return $this->render('create', [
            'model' => $model,
            'notification' => $notification,
        ]);
    }

    /**
     * Updates an existing Helpdesk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $notification = $this->findNotification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
            'notification' => $notification,
        ]);
    }

    /**
     * Deletes an existing Helpdesk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

	/**
     * in Approved an existing Helpdesk model.
     * System fulfilled problem.
     * If close is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionClose($id)
    {
		if ($model = $this->findModel($id)) {
            $model->status = Helpdesk::STATUS_CHECKING;
            $model->save();
        }

		return $this->redirect(['index']);
    }

    /**
     * The customer clicked on to take
     * Problem solved and stamped datetime
     * if success redirected, the browser will be redirected to the 'index' page.
     * @param $id
     * @return \yii\web\Response
     */
    public function actionApproved($id)
    {
        $model = $this->findModel($id);
        $model->status = Helpdesk::STATUS_APPROVED;
        $model->endDate = date('Y-m-d H:m:s');
        $model->save();
        Yii::$app->session->addFlash('update', 'Заявка была закрыта');

        return $this->redirect(['index']);
    }

    /**
     * Page for eclined problem
     * if we receive s POST request, add model->status STATUS_DECLINED
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionDeclinedHelp($id)
    {
        $model = $this->findModel($id);
        $user = User::findOne(['id' => User::USER_SYSTEM]);

        if ($model->load(Yii::$app->request->post())){
            $model->status = Helpdesk::STATUS_DECLINED;
            if (!$model->save()){
               $this->flashErrors($id);
            } else {
                try{
                    Yii::$app->bot->sendMessage($user->telegram_chat_id, 'Отклонена поломку '.$model->commetnt.' По причине: '.$model->declined);
                    return $this->redirect(['index']);
                }catch (Exception $e){
                    $e->getMessage();
                }
            }
        }

        return $this->renderAjax('declined-help', ['model' => $model]);
    }

    /**
     * Finds the Helpdesk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Helpdesk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Helpdesk::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param null $id
     */
    private function flashErrors($id = null)
    {
        $id == null ? $model = new Zakaz() : $this->findModel($id);
        Yii::$app->session->addFlash('errors', 'Произошла ошибка! '.$model->getErrors());
    }

    /**
     * Find the Notification model
     * If the user notification > 50, it shows 50+ notification
     */
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
