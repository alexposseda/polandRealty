<?php

    namespace console\controllers;

    use console\rbac\DeleteAdRule;
    use console\rbac\UpdateAdRule;
    use Yii;
    use yii\console\Controller;

    class RbacController extends Controller{
        public function actionInit(){
            $auth = Yii::$app->authManager;

            $createAd = $auth->createPermission('createAd');
            $auth->add($createAd);

            $updateAd = $auth->createPermission('updateAd');
            $auth->add($updateAd);

            $deleteAd = $auth->createPermission('deleteAd');
            $auth->add($deleteAd);
            
            $changeStatus = $auth->createPermission('changeStatus');
            $auth->add($changeStatus);
            
            $adminAccess = $auth->createPermission('adminAccess');
            $auth->add($adminAccess);
            
            $updateRule = new UpdateAdRule();
            $auth->add($updateRule);
            $updateOwnAd = $auth->createPermission('updateOwnAd');
            $updateOwnAd->ruleName = $updateRule->name;
            $auth->add($updateOwnAd);
            $auth->addChild($updateOwnAd, $updateAd);
    
            $deleteRule = new DeleteAdRule();
            $auth->add($deleteRule);
            $deleteOwnAd = $auth->createPermission('deleteOwnAd');
            $deleteOwnAd->ruleName = $deleteRule->name;
            $auth->add($deleteOwnAd);
            $auth->addChild($deleteOwnAd, $deleteAd);
            
            $registeredUser = $auth->createRole('registeredUser');
            $auth->add($registeredUser);
            $auth->addChild($registeredUser, $createAd);
            $auth->addChild($registeredUser, $updateOwnAd);
            $auth->addChild($registeredUser, $deleteOwnAd);
    
            $manager = $auth->createRole('manager');
            $auth->add($manager);
            $auth->addChild($manager, $updateAd);
            $auth->addChild($manager, $deleteAd);
            $auth->addChild($manager, $changeStatus);
            $auth->addChild($manager, $registeredUser);
    
            $admin = $auth->createRole('admin');
            $auth->add($admin);
            $auth->addChild($admin, $adminAccess);
            $auth->addChild($admin, $manager);
    
            $auth->assign($admin, 1);
        }
    }