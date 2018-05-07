<?php
/**
 * Created by PhpStorm.
 * User: holland
 * Date: 05.07.2017
 * Time: 14:15
 */
namespace frontend\components;
use app\models\User;
use yii\base\Widget;
use app\models\Notification;
use Yii;
use yii\helpers\Html;



class Notifications extends Widget
{
    public function run()
    {
        $notification = Notification::find();
        if (Yii::$app->user->can('admin')){
            $this->view->params['scoreNotification'] = $notification->andWhere(['active' => 1])->andWhere(['id_user' => 5 ])->count();

         } elseif (Yii::$app->user->can('master')){
            $this->view->params['scoreNotification'] = $notification->andWhere(['active' => 1])->andWhere(['id_user' => 4 ])->count();
          } elseif (Yii::$app->user->can('disain')){
            $this->view->params['scoreNotification'] = $notification->andWhere(['active' => 1])->andWhere(['id_user' => 3 ])->count();
        }elseif (Yii::$app->user->can('shop')){
            $this->view->params['scoreNotification'] = $notification->andWhere(['active' => 1])->andWhere(['id_user' => 9 ])->count();
        }

        if (!Yii::$app->user->isGuest){
            $notifications = Notification::find()->where(['id_user' => Yii::$app->user->id, 'active' => 1])->all();

            echo '<div class="notification">';

            echo $notifications == null ? '<div class="notification-icon">' : '<div class="notification-icon newNotification">'.$this->view->params['scoreNotification']./*Yii::$app->session->addFlash('update', 'Появились новые уведомления');*/'';
            echo '<span class="glyphicon glyphicon-bell"></span>
                </div>
                <div class="notification-container hidden">
                <div class="notification-container_message">';
            foreach ($notifications as $notification){
                echo '<div>'.Html::a($notification->name, ['notification/read-notice', 'id' => $notification->id], ['class' => 'notification-content']).'</div>';
            }
            echo '</div><div class="notification-all"><span>'.Html::a('Показать все', ['notification/index']).'</span></div>';
            echo '</div>
            </div>';
        }
    }
}