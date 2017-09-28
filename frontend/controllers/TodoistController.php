<?php

namespace frontend\controllers;

use app\models\Comment;
use frontend\models\Telegram;
use Yii;
use app\models\Todoist;
use app\models\Helpdesk;
use app\models\Custom;
use yii\base\Model;
use app\models\TodoistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
    					'roles' => ['admin', 'program', 'manager'],
					],
					[
    					'actions' => ['shop'],
    					'allow' => true,
    					'roles' => ['shop', 'zakup', 'master', 'disain', 'program', 'courier', 'system'],
					],
					[
    					'actions' => ['close', 'create', 'update', 'declined', 'accept', 'todoist-detail'],
    					'allow' => true,
    					'roles' => ['@'],
					],
                    [
                        'actions' => ['closetodoist'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
					[
    					'actions' => ['createzakaz'],
    					'allow' => true,
    					'roles' => ['admin', 'shop'],
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'admin-their');
        $dataProviderAlien = $searchModel->search(Yii::$app->request->queryParams, 'admin-alien');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderAlien' => $dataProviderAlien,
        ]);
    }

    /**
     * @return string
     */
    public function actionTodoistDetail()
    {
        $id = Yii::$app->request->post('expandRowKey');
        $model = $this->findModel($id);
        $comment = Comment::find()->todoist($id);
        $commentForm = new Comment();

        if (isset($id)){
            return $this->renderPartial('_todoist-detail', [
                'model'=>$model,
                'comment' => $comment,
                'commentForm' => $commentForm,
            ]);
        } else {
            return '<div class="alert alert-danger">Страница не найдена</div>';
        }
    }
    /**
     * Close all Todoist models.
     * @return mixed
     */
    public function actionClosetodoist()
    {
        $searchModel = new TodoistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'close');

        return $this->render('closetodoist', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Todoist shop models.
     * @return mixed
     */
    public function actionShop()
    {
        $searchModel = new TodoistSearch();
        $dataProviderTheir = $searchModel->search(Yii::$app->request->queryParams, 'shop-their');
        $dataProviderAlien = $searchModel->search(Yii::$app->request->queryParams, 'shop-alien');

        return $this->render('shop', [
            'dataProviderTheir' => $dataProviderTheir,
            'dataProviderAlien' => $dataProviderAlien,
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
        $telegram = new Telegram();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()){
                Yii::$app->session->addFlash('update', 'Задача успешна создана');
                $telegram->message($model->id_user, 'Задача была поставлена: '.$model->comment);
                $this->findView();
            } else {
                print_r($model->getErrors());
                Yii::$app->session->addFlash('errors', 'Произошла ошибка! '.$model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Todoist shop model.
     * If creation is successful, the browser will be redirected to the 'shop' page.
     * temporarily deleted
     * @return mixed
     */
    private function actionCreate_shop()
    {
        $model = new Todoist();
        $helpdesk = new Helpdesk();
        $models = [new Custom()];
        $model->scenario = Todoist::SCENARIO_DECLINED;

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

    public function actionCreatezakaz()
    {
        $model = new Todoist();
        $telegram = new Telegram();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $telegram->message($model->id_user, 'Задача была поставлена "'.$model->comment.'" по заказу '.$model->idZakaz->prefics);
            $this->findView();
        }
        return $this->render('createzakaz', [
            'model' => $model,
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
        $telegram = new Telegram();
        $model->activate = Todoist::CLOSE;
		$model->save();
		$telegram->message($model->id_user, 'Задача '.$model->comment.' была закрыта');

        return $this->findView();
    }

    /**
     * Completed task
     * if success then the user redirected amin in index, for shop in shop
     * @param $id
     * @return \yii\web\Response
     */
    public function actionAccept($id)
    {
        $model = $this->findModel($id);
        $model->activate = Todoist::COMPLETED;
        $telegram = new Telegram();
        if (!$model->save()){
            print_r($model->getErrors());
        } else {
            $telegram->message($model->id_sotrud_put, $model->idUser->name.' выполнил задачу '.$model->idZakaz->prefics);
        }

        return $this->findView();
    }

    /**
     * Declined task
     * if success then the user redirected admin in index, for shop in shop
     * @param $id
     * @return string
     */
    public function actionDeclined($id)
    {
        $model = $this->findModel($id);
        $telegram = new Telegram();

        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->activate = Todoist::REJECT;
            if (!$model->save()){
                print_r($model->getErrors());
            }else{
                $telegram->message($model->id_user, $model->idSotrudPut->name.' отклонил Вами выполненную задачу по причине: '.$model->declined);
                $this->findView();
            };
        }

        return $this->renderAjax('declined', ['model' =>$model]);
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

    protected function findView()
    {
        if (Yii::$app->user->can('admin')){
            return $this->redirect(['index']);
        } else {
            return $this->redirect(['shop']);
        }
    }
}
