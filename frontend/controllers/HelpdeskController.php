<?php

namespace frontend\controllers;

use app\models\Courier;
use app\models\Custom;
use app\models\Todoist;
use app\models\Zakaz;
use Yii;
use app\models\Helpdesk;
use app\models\HelpdeskSearch;
use app\models\Notification;
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $notification = $this->findNotification();
        $score = $this->findScorezakaz('admin');
        $scoreTodoist  = $this->findScoretodoist('admin');
        if (Yii::$app->user->can('system')){
            $scoreHelp = $this->findScorehelp('system');
        } else {
            $scoreHelp = $this->findScorehelp('adop');
        }
        if (Yii::$app->user->can('zakup')){
            $scoreCustom = $this->findScorecustom('zakup');
        } else {
            $scoreCustom = $this->findScorecustom('adop');
        }
        $scoreShipping = $this->findScoreshipping();



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notification' => $notification,
            'score' => $score,
            'scoreTodoist' => $scoreTodoist,
            'scoreHelp' => $scoreHelp,
            'scoreCustom' => $scoreCustom,
            'scoreShipping' => $scoreShipping,
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
        $notification = $this->findNotification();
        $score = $this->findScorezakaz('admin');
        $scoreTodoist  = $this->findScoretodoist('admin');
        $scoreHelp = $this->findScorehelp('adop');
        if (Yii::$app->user->can('zakup')){
            $scoreCustom = $this->findScorecustom('zakup');
        } else {
            $scoreCustom = $this->findScorecustom('adop');
        }
        $scoreShipping = $this->findScoreshipping();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
            } else {
                print_r($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
            'notification' => $notification,
            'score' => $score,
            'scoreTodoist' => $scoreTodoist,
            'scoreHelp' => $scoreHelp,
            'scoreCustom' => $scoreCustom,
            'scoreShipping' => $scoreShipping,
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
     * Close problem an existing Helpdesk model.
     * If close is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionClose($id)
    {
		if ($model = $this->findModel($id)) {
            $model->status = 1;
			$model->endDate = date('Y-m-d H:m:s');
            $model->save();
        }

		return $this->redirect(['index']);
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

    /**
     * Finds the Zakaz model based on its role value
     * @param $role
     * @return int|string
     */
    protected function findScorezakaz($role)
    {
        $score = Zakaz::find();

        switch ($role) {
            case 'admin':
                return $this->view->params['scoreZakaz'] = $score->andWhere(['action' => 1])->count();
                break;
            case 'shop':
                return $this->view->params['scoreZakaz'] = $score->andWhere(['id_sotrud' => Yii::$app->user->id, 'action' => 1])->count();
                break;
            case 'disain':
                return $this->view->params['scoreDisain'] = $score->andWhere(['status' => [Zakaz::STATUS_DISAIN, Zakaz::STATUS_SUC_DISAIN, Zakaz::STATUS_DECLINED_DISAIN], 'action' => 1])->count();
                break;
            case 'master':
                return $this->view->params['scoreMaster'] = $score->andWhere(['status' => [Zakaz::STATUS_MASTER, Zakaz::STATUS_SUC_MASTER, Zakaz::STATUS_DECLINED_MASTER], 'action' => 1])->count();
                break;
        }
    }

    /**
     * Finds the Todoist model based on its role value
     * @param $role
     * @return int|string
     */
    protected function findScoretodoist($role)
    {
        $score = Todoist::find();

        switch ($role) {
            case 'admin':
                return $this->view->params['scoreTodoist'] = $score->andWhere(['activate' => 0])->count();
                break;
            case 'adop':
                return $this->view->params['scoreTodoist'] = $score->andWhere(['id_user' => Yii::$app->user->id, 'activate' => 0])->count();
                break;
        }
    }

    /**
     * Finds the Helpdesk model
     * @param $role
     */
    protected function findScorehelp($role)
    {
        $score = Helpdesk::find();

        if ($role == 'system'){
            $this->view->params['scoreHelp'] = $score->andWhere(['status' => 0])->count();
        } else {
            $this->view->params['scoreHelp'] = $score->andWhere(['id_user' => Yii::$app->user->id, 'status' => 0])->count();
        }
    }

    /**
     * Finds the Custom model
     */
    protected function findScorecustom($role)
    {
        $score = Custom::find();
        if ($role == 'zakup'){
            $this->view->params['scoreCustom'] = $score->andWhere(['action' => 0])->count();
        } else {
            $this->view->params['scoreCustom'] = $score->andWhere(['id_user' => Yii::$app->user->id, 'action' => 0])->count();
        }

    }

    /**
     * Finds the Courier model
     */
    protected function findScoreshipping()
    {
        $score = Courier::find();
        $this->view->params['scoreShipping'] = $score->andWhere(['<','status', Courier::DELIVERED])->count();
    }
}
