<?php

namespace frontend\controllers;

use Yii;
use app\models\Zakaz;
use app\models\ZakazSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\rbac\AuthorRule;
use console\controllers\RbacController;
use yii\data\ActiveDataProvider;

/**
 * ZakazController implements the CRUD actions for Zakaz model.
 */
class ZakazController extends Controller
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
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['shop', 'admin', 'program'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['admin', 'disain', 'master', 'program'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['admin', 'disain', 'master', 'program', 'shop'],
                    ],
                    [
                        'actions' => ['check'],
                        'allow' => true,
                        'roles' => ['master', 'program'],
                    ],
                    [
                        'actions' => ['admin'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['shop'],
                        'allow' => true,
                        'roles' => ['shop', 'program'],
                    ],
                    [
                        'actions' => ['disain'],
                        'allow' => true,
                        'roles' => ['disain', 'program'],
                    ],
                    [
                        'actions' => ['master'],
                        'allow' => true,
                        'roles' => ['master', 'program'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Zakaz models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Zakaz model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if ($model = $this->findModel($id)) {
            $model->status = 7;
            $model->save();
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'user_name' => $user_name,
        ]);
    }

    /**
     * Creates a new Zakaz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Zakaz();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Zakaz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_zakaz]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionCheck($id)
    {
        if ($model = $this->findModel($id)) {
            $model->status = 7;
            $model->save();
        } return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Deletes an existing Zakaz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionShop()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'shop');

        return $this->render('shop', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDisain()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'disain');

        return $this->render('disain', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionMaster()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'master');

        return $this->render('master', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAdmin()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'admin');

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Zakaz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Zakaz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Zakaz::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
