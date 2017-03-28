<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use app\rbac\ShopRule;

class RbacController extends Controller
{
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

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $seeAdmin);
        $auth->addChild($admin, $seeAdop);

        $shop = $auth->createRole('shop');
        $auth->add($shop);
        $auth->addChild($shop, $seeShop);
        $auth->addChild($shop, $updateOwnZakaz);
        $auth->addChild($shop, $seeAdop);

        $master = $auth->createRole('master');
        $auth->add($master);
        $auth->addChild($master, $seeMaster);
        $auth->addChild($master, $seeIspol);

        $disain = $auth->createRole('disain');
        $auth->add($disain);
        $auth->addChild($disain, $seeDisain);
        $auth->addChild($disain, $seeIspol);

        $prog = $auth->createRole('program');
        $auth->add($prog);
        $auth->addChild($prog, $admin);
        $auth->addChild($prog, $disain);
        $auth->addChild($prog, $master);
        $auth->addChild($prog, $shop);

        $auth->assign($admin, 5);
        $auth->assign($disain, 3);
        $auth->assign($master, 4);
        $auth->assign($shop, 2);
        $auth->assign($prog, 1);
    }
}