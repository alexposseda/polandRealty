<?php

    namespace frontend\controllers;

    use common\models\search\RealtySearch;
    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;

    class UserController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => ['view'],
                            'allow'   => true,
                            'roles'   => ['?'],
                        ],
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                //                'verbs'  => [
                //                    'class'   => VerbFilter::className(),
                //                    'actions' => [
                //                        'delete' => ['post'],
                //                    ],
                //                ],
            ];
        }

        public function actionIndex(){
            $searchModel = new RealtySearch();
            if(!Yii::$app->authManager->checkAccess(Yii::$app->user->id, 'manager')){
                $searchModel->created_by = Yii::$app->user->id;
            }
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }

        public function actionProfile(){
            $model = Yii::$app->user->identity;

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->goHome();
            }

            return $this->render('profile', ['model' => $model]);
        }

        public function actionView($id){
            //todo выводим информацию о пользователе
        }
    }