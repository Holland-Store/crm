<?php

namespace frontend\controllers;

use app\models\User;
use app\models\Zakaz;
use frontend\models\Telegram;
use Yii;
use app\models\Courier;
use app\models\Notification;
use app\models\CourierSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * CourierController implements the CRUD actions for Courier model.
 */
class CourierController extends Controller
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
                       'actions' => ['index', 'ready', 'make', 'delivered'],
                       'allow' => true,
                       'roles' => ['courier'],
                   ],
                   [
                        'actions' => ['shipping', 'deletes', 'create'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                   ],
                ],
            ],
        ];
    }

    /**
     * Lists all Courier models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourierSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionReady()
    {
        $courier = Courier::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $courier->andWhere(['>', 'data_from', '0000-00-00 00:00:00']),
            'pagination' => ['pageSize' => 50,]
            ]);
        
        return $this->render('ready', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /** View for admin scans all active shipping */
    public function actionShipping()
    {
        $courier = Courier::find();
        $searchModel = new CourierSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => $courier->where(['status' => Courier::DOSTAVKA]),
            'pagination' => ['pageSize' => 50,]
        ]);

        return $this->render('shipping', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Delete shipping after courier not accepted shipping
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDeletes($id)
    {
        $model =  $this->findModel($id);
        $telegram = new Telegram();
        $model->status = Courier::CANCEL;
        if(!$model->save()){
            $this->flashErrors($id);
        } else {
            Yii::$app->session->addFlash('update', 'Доставка былаа отклонена');
            $telegram->message(User::USER_COURIER, 'Отменена доставка '.$model->idZakaz->prefics);
        }

        return $this->redirect(['shipping']);
    }

    /**
     * Displays a single Courier model.
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
     * Creates a new Courier model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Courier();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()){
                Yii::$app->session->addFlash('update', 'Доставка былаа отклонена');
                return $this->redirect('shipping');
            } else {
                print_r($model->getErrors());
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Courier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Courier model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionMake($id)//Курьер забрал заказ
    {
        $model = $this->findModel($id);
        $notification = new Notification();

        $model->data_to = date('Y-m-d H:i:s');
        $model->status = Courier::RECEIVE;

        $notification->getByIdNotification(5, $model->id_zakaz);//Уведомление, что курьер забрал доставку
        $notification->saveNotification;

        if ($model->save()){
            return $this->redirect(['index']);
        } else {
            print_r($model->getErrors());
        }
    }
    public function actionDelivered($id)//Курьер доставил заказ
    {
        $model = $this->findModel($id);
        $notification = new Notification();
        $model->data_from = date('Y-m-d H:i:s');
        $model->status = Courier::DELIVERED;

        $notification->getByIdNotification(8, $model->id_zakaz);//Уведомление, что курьер доставил доставку
        $notification->saveNotification;

        if ($model->save()){
            return $this->redirect(['index']);
        } else {
            print_r($model->getErrors());
        }
    }
    /**
     * Finds the Courier model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Courier the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Courier::findOne($id)) !== null) {
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
        /** @var $model \app\models\Zakaz */
        $id == null ? $model = new Zakaz() : $this->findModel($id);
        Yii::$app->session->addFlash('errors', 'Произошла ошибка! '.$model->getErrors());
    }
}
