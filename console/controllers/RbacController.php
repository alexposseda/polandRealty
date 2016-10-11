<?php

    namespace console\controllers;

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

            $registeredUser = $auth->createRole('registeredUser');
            $auth->add($registeredUser);
            $auth->addChild($registeredUser, $createAd);

            $manager = $auth->createRole('manager');
            $auth->add($manager);
            $auth->addChild($manager, $updateAd);
            $auth->addChild($manager, $deleteAd);
            $auth->addChild($manager, $registeredUser);

            $admin = $auth->createRole('admin');
            $auth->add($admin);
            $auth->addChild($admin, $manager);
        }
    }