<?php

namespace frontend\controllers;

use Yii;
use app\models\Todoist;
use app\models\Helpdesk;
use app\models\Custom;
use yii\base\Model;
use app\models\Notification;
use app\models\TodoistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * TodoistController implements the CRUD actions for Todoist model.
 */
class TodoistController extends Controller
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
    					'roles' => ['admin', 'program'],
					],
					[
    					'actions' => ['shop'],
    					'allow' => true,
    					'roles' => ['shop', 'zakup', 'master', 'disain', 'program'],
					],
					[
    					'actions' => ['close'],
    					'allow' => true,
    					'roles' => ['shop', 'zakup', 'disain', 'master'],
					],
                    [
                        'actions' => ['closetodoist'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
					[
    					'actions' => ['createzakaz'],
    					'allow' => true,
    					'roles' => ['admin'],
					],
					[
    					'actions' => ['create_shop'],
    					'allow' => true,
    					'roles' => ['shop'],
					],
				],
			],
        ];
    }

    /**
     * Lists all Todoist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TodoistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'admin');
        $notification = $this->findNotification();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notifivation' => $notification,
        ]);
    }
    /**
     * Close all Todoist models.
     * @return mixed
     */
    public function actionClosetodoist()
    {
        $searchModel = new TodoistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'close');
        $notification = $this->findNotification();

        return $this->render('closetodoist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notifivation' => $notification,
        ]);
    }
    /**
     * Lists all Todoist shop models.
     * @return mixed
     */
    public function actionShop()
    {
        $dataProvider = new ActiveDataProvider([
			'query' => Todoist::find()->where(['id_user' => Yii::$app->user->id, 'activate' => 0])
		]);
        $notification = $this->findNotification();

        return $this->render('shop', [
            'dataProvider' => $dataProvider,
            'notification' => $notification,
        ]);
    }

    /**
     * Displays a single Todoist model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Todoist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Todoist();
        $notification = $this->findNotification();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()){
                return $this->redirect(['index', 'id' => $model->id]);
                Yii::$app->session->addFlash('update', 'Задача успешна создана');
            } else {
                print_r($model->getErrors());
                Yii::$app->session->addFlash('errors', 'Произошла ошибка!');
            }
        }
        return $this->render('create', [
            'model' => $model,
            'notifivation' => $notification,
        ]);
    }

    /**
     * Creates a new Todoist shop model.
     * If creation is successful, the browser will be redirected to the 'shop' page.
     * temporarily deleted
     * @return mixed
     */
    public function actionCreate_shop()
    {
        $model = new Todoist();
        $helpdesk = new Helpdesk();
        $models = [new Custom()];
        $notification = $this->findNotification();

        $data = Yii::$app->request->post('Custom', []);
        foreach (array_keys($data) as $index) {
            $models[$index] = new Custom();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['shop']);
        } elseif ($helpdesk->load(Yii::$app->request->post()) && $helpdesk->save()) {
            return $this->redirect(['shop']); 
        } elseif (Model::loadMultiple($models, Yii::$app->request->post())) {
            foreach ($models as $custom) {
                $custom->save();
            }
            return $this->redirect(['shop']);
        }
        else {
            return $this->render('create_shop', [
                'model' => $model,
                'helpdesk' => $helpdesk,
                'models' => $models,
                'notification' => $notification,
            ]);
        }
    }

    /**
     * Updates an existing Todoist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Deletes an existing Todoist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCreatezakaz()
    {
        $model = new Todoist();
        
        $notification = $this->findNotification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('createzakaz', [
            'model' => $model,
            'notifivation' => $notification,
            ]);
    }

	/**
     * Closse an existing Todoist model.
     * If close is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionClose($id)
    {
        $model = $this->findModel($id);
		$model->activate = 1;
		$model->save();

        return $this->redirect(['shop']);
    }

    /**
     * Finds the Todoist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Todoist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Todoist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Notification for user
     * If notification >50, it writing 50+
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
