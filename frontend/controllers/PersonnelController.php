<?php

namespace frontend\controllers;

use app\models\Personnel;

class PersonnelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Personnel::find()->with('idPosition')->where(['action' => Personnel::WORK])->orderBy('id_position ASC')->all();
        $count = Personnel::find()->with('idPosition')->where(['action' => Personnel::WORK])->count();
        return $this->render('index', ['model' => $model, 'count' => $count]);
    }

}
