<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use app\models\Todoist;
use app\models\Helpdesk;
use app\models\Custom;


/* @var $this yii\web\View */
/* @var $model app\models\Todoist */
/* @var $model app\models\Helpdesk */
/* @var $model app\models\Custom */

$this->title = 'Создать задачу';

?>
<div class="todoist-create-shop">

<<<<<<< HEAD
<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
=======
    <h1><?= Html::encode($this->title) ?></h1>
>>>>>>> 94df34a55697b2e667b1a48fb1174487f2ae0b32

    <?php echo Tabs::widget([
    	'items' => [
    		[
    			'label' => 'Help Desk',
    			'content' => $this->render('_form-helpdesk', [
						        'helpdesk' => $helpdesk,
						    ]),
    		],
    		[
    			'label' => 'Запрос',
    			'content' => $this->render('_form-custom', [
						        'models' => $models,
						    ]),
    		],
    	],
    ]); ?>

</div>
