<?php

namespace frontend\controllers;

use app\models\Financy;
use app\models\Zakaz;
use Yii;
use \yii\web\Controller;

class FinancyController extends Controller
{
    public function actionDraft($id)
    {
        $model = Zakaz::findOne($id);
        $financy = new Financy();
        $financy->amount = $model->oplata - $model->fact_oplata;

        if ($financy->load(Yii::$app->request->post()) && $financy->validate()){
            $model->fact_oplata = $model->fact_oplata + $financy->sum;
            if ($model->oplata >= $model->fact_oplata){
                if ($model->oplata > $model->fact_oplata){
                    $model->save();
                    Yii::$app->session->addFlash('update', 'Сумма зачлась');
                    if (Yii::$app->user->can('admin')){
                        return $this->redirect(['zakaz/admin', 'id' => $id]);
                    } else {
                        return $this->redirect(['zakaz/shop']);
                    }
                } else {
                    $model->action = 0;
                    $model->save();
                    Yii::$app->session->addFlash('update', 'Заказ был закрыт');
                    if (Yii::$app->user->can('admin')){
                        return $this->redirect(['zakaz/admin', 'id' => $id]);
                    } else {
                        return $this->redirect(['zakaz/shop']);
                    }
                }
            }
        }
    }
}
