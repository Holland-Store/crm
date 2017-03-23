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
                        'roles' => ['shop', 'admin'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['admin']
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
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $seatchPhone = Yii::$app->request->get('PhoneSearch');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seatchPhone' => $seatchPhone,
        ]);
    }

    /**
     * Displays a single Zakaz model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

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
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $rule = new AuthorRule;
        $auth->add($true);

        $role = $auth->createRole('admin');
        $role->description = "Администратор";
        $auth->add($role);

        $role = $auth->createRole('shop');
        $role->description = "Магазин";
        $auth->add($role);

        $userRole = Yii::$app->authManager->getRole('admin');
        Yii::$app->authManager->assign($userRole, Yii::$app->user->getId());

        $create = Yii::$app->authManager->createPremission('createZakaz');
        $create->description = 'Создать заказ';
        Yii::$app->authManager->add($create);

        $update = Yii::$app->authManager->createPremission('updateZakaz');
        $update->description = 'Право на редактирование заказа';
        Yii::$app->authManager->add($update);

        if (\Yii::$app->user->can('updateZakaz')) 
        {
            $role->$auth('admin');
        }
        else throw ForbiddenHttpException('У Вас недостаточно прав для выполнение указанного действия');

        $updateOwnPost = $auth->createPremission('updateOwnPost');
        $updateOwnPost->description = 'Редактировать запись';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);

        $author = Yii::$app->authManager->getRole('shop');
        $auth->addChild($author, $updateOwnPost);

        if (\Yii::$app->user->can('updateZakaz', ['post' => $post])) {
            $role->$auth('admin');
        }
    }
}
