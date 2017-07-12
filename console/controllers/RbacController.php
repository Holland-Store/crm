<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use app\rbac\ShopRule;

class RbacController extends Controller
{
    /**
     * role and prmission for user
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $rule = new ShopRule;
        $auth->add($rule);

        $updateZakaz = $auth->createPermission('updateZakaz');
        $updateZakaz->description = 'Редактировать Заказ';
        $auth->add($updateZakaz);

        $updateOwnZakaz = $auth->createPermission('updateOwnZakaz');
        $updateOwnZakaz->description = 'Редактировать собственный заказ';
        $updateOwnZakaz->ruleName = $rule->name;
        $auth->add($updateOwnZakaz);
        $auth->addChild($updateOwnZakaz, $updateZakaz);

        $seeDisain = $auth->createPermission('seeDisain');
        $seeDisain->description = 'Виднеется меню Дизайнера';
        $auth->add($seeDisain);

		$seeAllIspol = $auth->createPermission('seeAllIspol');
		$seeAllIspol->descriptio = 'Виднеются всем кроме Админу';
		$auth->add($seeAllIspol);

        $seeCourier = $auth->createPermission('seeCourier');
        $seeCourier->description = 'Виднеется меню Курьера';
        $auth->add($seeCourier);

        $seeMaster = $auth->createPermission('seeMaster');
        $seeMaster->description = 'Виднеется меню Мастер';
        $auth->add($seeMaster);

        $seeShop = $auth->createPermission('seeShop');
        $seeShop->description = 'Виднеется меню Магазину';
        $auth->add($seeShop);

        $seeAdmin = $auth->createPermission('seeAdmin');
        $seeAdmin->description = 'Виднеется меню Админ';
        $auth->add($seeAdmin);

        $seeProg = $auth->createPermission('seeProg');
        $seeProg->description = 'Виднеется меню Программист';
        $auth->add($seeProg);

        $seeIspol = $auth->createPermission('seeIspol');
        $seeIspol->description = 'Видят исполнители';
        $auth->add($seeIspol);

        $seeAdop = $auth->createPermission('seeAdop');
        $seeAdop->description = 'Видит магазин и админ';
        $auth->add($seeAdop);

        $todoist = $auth->createPermission('todoist');
        $todoist->description = 'Видят задачник';
        $auth->add($todoist);        

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $seeAdmin);
        $auth->addChild($admin, $seeDisain);
        $auth->addChild($admin, $seeAdop);
        $auth->addChild($admin, $seeCourier);

        $shop = $auth->createRole('shop');
        $auth->add($shop);
        $auth->addChild($shop, $seeShop);
        $auth->addChild($shop, $updateOwnZakaz);
        $auth->addChild($shop, $seeAdop);
        $auth->addChild($shop, $todoist);

        $master = $auth->createRole('master');
        $auth->add($master);
        $auth->addChild($master, $seeMaster);
        $auth->addChild($master, $seeIspol);
		$auth->addChild($master, $seeAllIspol);
        $auth->addChild($master, $todoist);

        $disain = $auth->createRole('disain');
        $auth->add($disain);
        $auth->addChild($disain, $seeDisain);
        $auth->addChild($disain, $seeIspol);
		$auth->addChild($disain, $seeAllIspol);
        $auth->addChild($disain, $todoist);

        $courier = $auth->createRole('courier');
        $auth->add($courier);
        $auth->addChild($courier, $seeCourier);

        $zakup = $auth->createRole('zakup');
        $auth->add($zakup);
        $auth->addChild($zakup, $seeAllIspol);
        $auth->addChild($zakup, $todoist);

        $system = $auth->createRole('system');
        $auth->add($system);
        $auth->addChild($system, $seeAllIspol);

        $prog = $auth->createRole('program');
        $auth->add($prog);
        $auth->addChild($prog, $admin);
        $auth->addChild($prog, $disain);
        $auth->addChild($prog, $master);
        $auth->addChild($prog, $shop);
        $auth->addChild($prog, $courier);
		$auth->addChild($prog, $zakup);
		$auth->addChild($prog, $system);

		$auth->assign($zakup, 8);
		$auth->assign($system, 9);
        $auth->assign($courier, 7);
        $auth->assign($admin, 5);
        $auth->assign($disain, 3);
        $auth->assign($master, 4);
        $auth->assign($shop, 2);
        $auth->assign($shop, 6);
        $auth->assign($prog, 1);
    }
}
