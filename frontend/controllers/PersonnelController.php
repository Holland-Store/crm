<?php

namespace frontend\controllers;

use app\models\Financy;
use app\models\PersonnelPosition;
use app\models\Shifts;
use Yii;
use app\models\Personnel;
use app\models\PersonnelSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * PersonnelController implements the CRUD actions for Personnel model.
 */
class PersonnelController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['shifts', 'view', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['manager'],
                    ]
                ]
            ],
        ];
    }

    /**
     * Lists all Personnel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonnelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Personnel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $modelPersonnel = $this->findModel($id);
        $model = Shifts::find()->where(['id_sotrud' => $id])->all();
        $sumShifts = Shifts::find()->where(['id_sotrud' => $id])->sum('number');
        $financy = Financy::find()->where(['id_employee' => $modelPersonnel->id])->all();
        $sumFinancy = Financy::find()->where(['id_employee' => $modelPersonnel->id])->sum('sum');
        $sumFine = Financy::find()->where(['id_employee' => $modelPersonnel->id, 'category' => 1])->sum('sum');
        $sumBonus = Financy::find()->where(['id_employee' => $modelPersonnel->id, 'category' => 2])->sum('sum');
        $sumWage = $sumFine-$sumBonus;

        return $this->render('view', [
            'model' => $model,
            'modelPersonnel' => $modelPersonnel,
            'sumShifts' => $sumShifts,
            'financy' => $financy,
            'sumFinancy' => $sumFinancy,
            'sumWage' => $sumWage,
            ]);
    }

    /**
     * Creates a new Personnel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Personnel();
        $position = new PersonnelPosition();

        if ($model->load(Yii::$app->request->post()) && $position->load(Yii::$app->request->post()) && $model->save()) {
            $position->personnel_id = $model->id;
            $position->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'position' => $position
            ]);
        }
    }

    /**
     * Updates an existing Personnel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $position = new PersonnelPosition();

        if ($model->load(Yii::$app->request->post()) && $position->load(Yii::$app->request->post()) && $model->save()) {
            $position->personnel_id = $id;
            $position->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'position' => $position,
            ]);
        }
    }

    /**
     * Those who work as employees
     * @return string
     */
    public function actionShifts()
    {
        $searchModel = new PersonnelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('shifts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }


    /**
     * Deletes an existing Personnel model.
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
     * Finds the Personnel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Personnel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Personnel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
