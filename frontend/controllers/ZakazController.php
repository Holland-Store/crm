<?php

namespace frontend\controllers;

use app\models\Client;
use Yii;
use app\models\Zakaz;
use app\models\Courier;
use app\models\Comment;
use app\models\Notification;
use app\models\ZakazSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
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
                        'roles' => ['admin', 'disain', 'master', 'program', 'shop'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['admin', 'disain', 'master', 'program', 'shop', 'zakup'],
                    ],
                    [
                        'actions' => ['check'],
                        'allow' => true,
                        'roles' => ['master', 'program'],
                    ],
                    [
                        'actions' => ['uploadedisain'],
                        'allow' => true,
                        'roles' => ['disain', 'program'],
                    ],
                    [
                        'actions' => ['close'],
                        'allow' => true,
                        'roles' => ['admin', 'program', 'shop'],
                    ],
                    [
                        'actions' => ['restore'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
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
                    [
                        'actions' => ['courier'],
                        'allow' => true,
                        'roles' => ['courier', 'program'],
                    ],
                    [
                        'actions' => ['archive'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['closezakaz'],
                        'allow' => true,
                        'roles' => ['shop', 'program'],
                    ],
                    [
                        'actions' => ['ready'],
                        'allow' => true,
                        'roles' => ['disain', 'program'],
                    ],
                    [
                        'actions' => ['adopted'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['adopdisain'],
                        'allow' => true,
                        'roles' => ['disain', 'program'],
                    ],
                    [
                        'actions' => ['adopmaster'],
                        'allow' => true,
                        'roles' => ['master', 'program'],
                    ],
                    [
                        'actions' => ['statusdisain'],
                        'allow' => true,
                        'roles' => ['disain', 'program'],
                    ],
                    [
                        'actions' => ['zakazedit'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['zakaz'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['comment'],
                        'allow' => true,
                        'roles' => ['admin', 'program'],
                    ],
                    [
                        'actions' => ['declined'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'actions' => ['accept'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'actions' => ['fulfilled'],
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'actions' => ['reconcilation'],
                        'allow' => true,
                        'roles' => ['disain']
                    ]
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
        $model = new Zakaz();
        $notification = $this->findNotification();

        return $this->render('index', [
            'model' => $model,
            'notification' => $notification,
        ]);
    }

    /**
     * Displays a single Zakaz model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $notifications = new Notification();
        $shipping = new Courier();
        $reminder = new Notification();
        $zakaz = $model->id_zakaz;
        $notification = $this->findNotification();


        if ($shipping->load(Yii::$app->request->post())) {
            $shipping->save();
            $model->id_shipping = $shipping->id;//Оформление доставки
            $model->save();

            $notifications->getByIdNotification(7, $zakaz);
            $notifications->saveNotification;

//            return $this->redirect(['view', 'id' => $model->id_zakaz]);
        }

        if ($reminder->load(Yii::$app->request->post())) {
            $reminder->getReminder($zakaz);
            if ($reminder->validate() && $reminder->save()) {
                Yii::$app->session->setFlash('success', 'Напоминание было создана');
            } else {
                Yii::$app->session->setFlash('error', 'Извините. Напоминание не было создана');
            }
            unset($reminder->srok);
            return $this->redirect(['view', 'id' => $model->id_zakaz]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->uploadeFile;//Выполнение работы дизайнером и оформление уведомление
            $model->validate();
            $model->save();

            if ($model->status == 3) {
                $notifications->getByIdNotification(4, $model->id_zakaz);
                $notifications->saveNotification;
            } elseif ($model->status == 6) {
                $notifications->getByIdNotification(3, $model->id_zakaz);
                $notifications->saveNotification;
            }

            return $this->redirect(['view', 'id' => $model->id_zakaz]);
        }
        $this->view->params['notifications'] = Notification::find()->where(['id_user' => Yii::$app->user->getId(), 'active' => true])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'notification' => $notification,
            'shipping' => $shipping,
            'reminder' => $reminder,
        ]);
    }

    /**
     * appointed shipping in courier
     * @param $id
     * @return string
     */
    public function actionShipping($id)
    {
        $model = $this->findModel($id);
        $shipping = new Courier();
        if ($model->load(Yii::$app->request->post())) {
            $shipping->save();
            $model->id_shipping = $shipping->id;
            if ($model->save()){
                Yii::$app->session->addFlash('update', 'Успешно создана доставка');
            } else {
                print_r($model->getErrors());
                Yii::$app->session->addFlash('errors', 'Произошла ошибка и доставка не была создана');
            }
        }

        return $this->render('shipping', [
            'model' => $model,
            'shipping' => $shipping,
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
        $client = new Client();
        $client->scenario = Client::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post()) && $client->load(Yii::$app->request->post())) {
            if (Yii::$app->request->get('id')){
                $model->id_client = ArrayHelper::getValue(Yii::$app->request->get(), 'id');
            } else {
                $model->id_client = ArrayHelper::getValue(Yii::$app->request->post('Client'), 'id');
            }
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                $model->upload();
                $model->img = time() . '.' . $model->file->extension;
            }
            if ($model->status == Zakaz::STATUS_DISAIN or $model->status == Zakaz::STATUS_MASTER or $model->status == Zakaz::STATUS_AUTSORS) {
                if ($model->status == Zakaz::STATUS_DISAIN) {
                    $model->statusDisain = Zakaz::STATUS_DISAINER_NEW;
                    $model->id_unread = 0;
                } elseif ($model->status == Zakaz::STATUS_MASTER) {
                    $model->statusMaster = Zakaz::STATUS_MASTER_NEW;
                    $model->id_unread = 0;
                } else {
                    $model->id_unread = 0;
                }
            }
            if ($model->validate() && $client->validate()){
                if (!$model->save()) {
                    print_r($model->getErrors());
                    Yii::$app->session->addFlash('errors', 'Произошла ошибка');
                } else {
                    $model->save();
                    Yii::$app->session->addFlash('update', 'Успешно создан заказ');
                }

                if (Yii::$app->user->can('shop')) {
                    return $this->redirect(['shop']);
                } elseif (Yii::$app->user->can('admin')) {
                    return $this->redirect(['admin']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'client' => $client,
        ]);
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
        $client = new Client();
        $client->scenario = Client::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post()) && $client->load(Yii::$app->request->post())) {
            $model->id_client = ArrayHelper::getValue(Yii::$app->request->post('Client'), 'id');
            $model->file = UploadedFile::getInstance($model, 'file');
            if (isset($model->file)) {
                $model->file->saveAs('attachment/' . $model->id_zakaz . '.' . $model->file->extension);
                $model->img = $model->id_zakaz . '.' . $model->file->extension;
            }
            if ($model->status == Zakaz::STATUS_DISAIN or $model->status == Zakaz::STATUS_MASTER or Zakaz::STATUS_AUTSORS) {
                if ($model->status == Zakaz::STATUS_DISAIN) {
                    $model->statusDisain = Zakaz::STATUS_DISAINER_NEW;
                    $model->id_unread = 0;
                } elseif ($model->status == Zakaz::STATUS_MASTER) {
                    $model->statusMaster = Zakaz::STATUS_MASTER_NEW;
                    $model->id_unread = 0;
                } else {
                    $model->id_unread = 0;
                }
            }
            if ($model->validate() && $client->validate()){
                if (!$model->save()) {
                    Yii::$app->session->addFlash('errors', 'Произошла ошибка');
                    print_r($model->getErrors());
                } else {
                    $model->save();
                    Yii::$app->session->addFlash('update', 'Успешно отредактирован заказ');
                }

                if (Yii::$app->user->can('shop')) {
                    return $this->redirect(['shop']);
                } elseif (Yii::$app->user->can('admin')) {
                    return $this->redirect(['admin']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'client' => $client,
        ]);
    }

    /**
     * Master fulfilled zakaz
     * if success redirected zakaz/master
     * @param $id
     * @return \yii\web\Response
     */
    public function actionCheck($id)//Мастер выполнил свою работу
    {
        $model = $this->findModel($id);
        $notification = new Notification();

        $model->status = Zakaz::STATUS_SUC_MASTER;
        $model->statusMaster = Zakaz::STATUS_MASTER_PROCESS;
        $model->id_unread = true;
        $notification->getByIdNotification(8, $id);
        $notification->saveNotification;
        if ($model->save()) {
            return $this->redirect(['master']);
            Yii::$app->session->addFlash('update', 'Заказ успешно выполнен');
        } else {
            print_r($model->getErrors());
            Yii::$app->session->addFlash('errors', 'Произошла ошибка! Заказ не выполнен');
        }
    }

    /**
     * Disain filfilled zakaz
     * @param $id
     * @return string
     */
    public function actionUploadedisain($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            //Выполнение работы дизайнером
            if (isset($model->file)) {
                $model->uploadeFile;
            }
            $model->status = Zakaz::STATUS_SUC_DISAIN;
            $model->statusDisain = Zakaz::STATUS_DISAINER_PROCESS;
            $model->id_unread = true;
            if ($model->save()) {
                Yii::$app->session->addFlash('update', 'Заказ успешно выполнен');
                return $this->redirect(['disain', 'id' => $id]);
            } else {
                print_r($model->getErrors());
                Yii::$app->session->addFlash('errors', 'Произошла ошибка! Заказ не выполнен');
            }
        }
        return $this->renderAjax('_upload', [
            'model' => $model
        ]);
    }

    /**
     * When zakaz close Shope or Admin
     * if success then redirected shop or admin
     * @param integer $id
     * @return mixed
     */
    public function actionClose($id)
    {
        $model = $this->findModel($id);
        $model->action = 0;
        if (!$model->save()) {
            print_r($model->getErrors());
            Yii::$app->session->addFlash('errors', 'Произошла ошибка!');
        } else {
            $model->save();
            Yii::$app->session->addFlash('update', 'Заказ успешно закрылся');
        }

        $this->view->params['notifications'] = Notification::find()->where(['id_user' => Yii::$app->user->id, 'active' => true])->all();

        if (Yii::$app->user->can('shop')) {
            return $this->redirect(['shop']);
        } elseif (Yii::$app->user->can('admin')) {
            return $this->redirect(['admin']);
        }
    }

    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->action = 1;
        $model->save();
        Yii::$app->session->addFlash('update', 'Заказ успешно активирован');

        return $this->redirect(['archive']);
    }

    /**
     * New zakaz become in status adopted
     * @param $id
     * @return \yii\web\Response
     */
    public function actionAdopted($id)
    {
        $model = $this->findModel($id);
        $model->status = Zakaz::STATUS_ADOPTED;
        $model->save();
    }

    /**
     * New zakaz become in status wokr for disain
     * @param $id
     * @return \yii\web\Response
     */
    public function actionAdopdisain($id)
    {
        $model = $this->findModel($id);
        $model->statusDisain = Zakaz::STATUS_DISAINER_WORK;
        $model->save();
    }

    /**
     * New zakaz become in status wokr for master
     * @param $id
     * @return \yii\web\Response
     */
    public function actionAdopmaster($id)
    {
        $model = $this->findModel($id);
        $model->statusMaster = Zakaz::STATUS_MASTER_WORK;
        $model->save();
    }

    /**
     * Zakaz fulfilled
     * if success then redirected zakaz/admin
     * @param $id
     * @return \yii\web\Response
     */
    public function actionFulfilled($id)
    {
        $model = $this->findModel($id);
        $model->status = Zakaz::STATUS_EXECUTE;
        $model->id_unread = 0;
        if ($model->save()) {
            return $this->redirect(['admin']);
        } else {
            print_r($model->getErrors());
        }
    }

    /**
     * Zakaz the disainer
     * if success then redirected zakaz/disain
     * @param $id
     * @return \yii\web\Response
     */
    public function actionReconcilation($id)
    {
        $model = $this->findModel($id);

        if ($model->statusDisain == Zakaz::STATUS_DISAINER_SOGLAS) {
            $model->statusDisain = Zakaz::STATUS_DISAINER_WORK;
        } else {
            $model->statusDisain = Zakaz::STATUS_DISAINER_SOGLAS;
        }
        if ($model->save()) {
            return $this->redirect(['disain']);
        } else {
            print_r($model->getErrors());
        }
    }

    /**
     * All existing close zakaz in Admin
     * @return string
     */
    public function actionArchive()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'archive');
        $notification = $this->findNotification();

        return $this->render('archive', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notification' => $notification,
        ]);
    }

    /** All close zakaz in shop */
    public function actionClosezakaz()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'closeshop');
        $notification = $this->findNotification();

        return $this->render('closezakaz', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notification' => $notification,
        ]);
    }

    /** All fulfilled disain */
    public function actionReady()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Zakaz::find()->andWhere(['status' => Zakaz::STATUS_SUC_DISAIN, 'action' => 1]),
            'sort' => ['defaultOrder' => ['srok' => SORT_DESC]]
        ]);
        $notification = $this->findNotification();

        return $this->render('ready', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notification' => $notification,
        ]);
    }

    /**
     * Disain internal status zakaz
     * @param $id
     * @return \yii\web\Response
     */
    public function actionStatusdisain($id)
    {
        $model = $this->findModel($id);
        $model->statusDisain = Zakaz::STATUS_DISAINER_WORK;
        $model->save();

        return $this->redirect(['view', 'id' => $model->id_zakaz]);
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
    /** START view role */
    /**
     * All zakaz existing in Shop
     * @return string
     */
    public function actionShop()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'shopWork');
        $dataProviderExecute = $searchModel->search(Yii::$app->request->queryParams, 'shopExecute');
        $notification = $this->findNotification();

        return $this->render('shop', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderExecute' => $dataProviderExecute,
            'notification' => $notification,
        ]);
    }

    /**
     * All zakaz existing in Disain
     * @return string
     */
    public function actionDisain()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'disain');
        $dataProviderSoglas = $searchModel->search(Yii::$app->request->queryParams, 'disainSoglas');
        $notification = $this->findNotification();

        return $this->render('disain', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderSoglas' => $dataProviderSoglas,
            'notification' => $notification,
        ]);
    }

    /**
     * All zakaz existing in Master
     * @return string
     */
    public function actionMaster()
    {
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'master');
        $dataProviderSoglas = $searchModel->search(Yii::$app->request->queryParams, 'masterSoglas');
        $notification = $this->findNotification();

        return $this->render('master', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderSoglas' => $dataProviderSoglas,
            'notification' => $notification,
        ]);
    }

    /**
     * All zakaz existing in Admin
     * @return string|\yii\web\Response
     * windows Admin
     */
    public function actionAdmin()
    {
        $notification = $this->findNotification();
        $notifications = new Notification();
        $model = new Zakaz();
        $comment = new Comment();
        $shipping = new Courier();

        if ($comment->load(Yii::$app->request->post())) {
            if ($comment->save()) {
                return $this->redirect(['admin']);
            } else {
                print_r($comment->getErrors());
            }
        }

        if ($shipping->load(Yii::$app->request->post())) {
            $shipping->save();//сохранение доставка
            if (!$shipping->save()) {
                Yii::warning($shipping->getErrors());
            }
            $model = Zakaz::findOne($shipping->id_zakaz);//Определяю заказ
            $model->id_shipping = $shipping->id;//Оформление доставку в таблице заказа
            if ($model->save()){
                Yii::$app->session->addFlash('update', 'Доставка успешна посталена');
            } else {
                Yii::$app->session->addFlash('errors', 'Произошла ошибка');
            }


            $notifications->getByIdNotification(7, $shipping->id_zakaz);//оформление уведомлений
            $notifications->saveNotification;

            return $this->redirect(['admin', '#' => $model->id_zakaz]);
        }

        $image = $model->img;
        $searchModel = new ZakazSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, 'admin');
        $dataProviderNew = $searchModel->search(Yii::$app->request->queryParams, 'adminNew');
        $dataProviderWork = $searchModel->search(Yii::$app->request->queryParams, 'adminWork');
        $dataProviderIspol = $searchModel->search(Yii::$app->request->queryParams, 'adminIspol');

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProviderNew' => $dataProviderNew,
            'dataProviderWork' => $dataProviderWork,
            'dataProviderIspol' => $dataProviderIspol,
            'image' => $image,
            'notification' => $notification,
        ]);
    }
    /** END view role */
    /** START Block admin in gridview */
    /**
     * Zakaz deckined admin and in db setup STATUS_DECLINED_DISAIN or STATUS_DECLINED_MASTER
     * if success then redirected view admin
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionDeclined($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Zakaz::SCENARIO_DECLINED;

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->status == Zakaz::STATUS_SUC_DISAIN) {
                    $model->status = Zakaz::STATUS_DECLINED_DISAIN;
                    $model->statusDisain = Zakaz::STATUS_DISAINER_DECLINED;
                    $model->id_unread = 0;
                } else {
                    $model->status = Zakaz::STATUS_DECLINED_MASTER;
                    $model->statusMaster = Zakaz::STATUS_MASTER_DECLINED;
                    $model->id_unread = 0;
                }
                if (!$model->save()) {
                    print_r($model->getErrors());
                } else {
                    $model->save();
                }
                return $this->redirect(['admin', '#' => $model->id_zakaz]);
            } else {
                return $this->renderAjax('_declined', ['model' => $model]);
            }
        } else {
            return $this->renderAjax('_declined', ['model' => $model]);
        }
    }

    /**
     * * Zakaz accept admin and in appoint
     * if success then redirected view admin
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionAccept($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->status == Zakaz::STATUS_DISAIN or $model->status == Zakaz::STATUS_MASTER or $model->status == Zakaz::STATUS_AUTSORS) {
                    if ($model->status == Zakaz::STATUS_DISAIN) {
                        $model->statusDisain = Zakaz::STATUS_DISAINER_NEW;
                        $model->id_unread = 0;
                    } elseif ($model->status == Zakaz::STATUS_MASTER) {
                        $model->statusMaster = Zakaz::STATUS_MASTER_NEW;
                        $model->id_unread = 0;
                    } else {
                        $model->id_unread = 0;
                    }
                }
                if ($model->save()) {
                    return $this->redirect(['admin', 'id' => $id]);
                } else {
                    print_r($model->getErrors());
                }
            } else {
                return $this->renderAjax('accept', ['model' => $model]);
            }
        }
        return $this->renderAjax('accept', ['model' => $model]);
    }

    /**
     * Bloc view zakaz in Admin
     * @param $id
     * @return string
     */
    public function actionZakaz($id)
    {
        $model = $this->findModel($id);

        return $this->renderPartial('_zakaz', [
            'model' => $model,
        ]);
    }
    /** END Block admin in gridview*/
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

    protected function findShipping($id)
    {
        if (($shipping = Courier::findOne($id)) !== null) {
            return $shipping;
        } else {
            throw new NotFoundHttpException("The requested page does not exist.");

        }
    }

    protected function findNotification()
    {
        $notifModel = Notification::find();
        $notification = $notifModel->where(['id_user' => Yii::$app->user->id, 'active' => true]);
        if ($notification->count() > 50) {
            $notifications = '50+';
        } elseif ($notification->count() < 1) {
            $notifications = '';
        } else {
            $notifications = $notification->count();
        }

        $this->view->params['notifications'] = $notification->all();
        $this->view->params['count'] = $notifications;
    }
}
