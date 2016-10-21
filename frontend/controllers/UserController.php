<?php

    namespace frontend\controllers;

    use common\models\search\RealtySearch;
    use common\models\User;
    use Yii;
    use yii\db\ActiveRecord;
    use yii\filters\AccessControl;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;

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
            /** @var ActiveRecord $model */
            $model = Yii::$app->user->identity;

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->goHome();
            }

            return $this->render('profile', ['model' => $model]);
        }

        public function actionView($id){
            $model = User::findOne($id);
            if(is_null($model)){
                throw new NotFoundHttpException('Not found');
            }

            return $this->render('view',['model'=>$model]);
        }
    }