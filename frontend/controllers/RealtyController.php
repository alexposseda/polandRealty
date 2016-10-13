<?php
    
    namespace frontend\controllers;
    
    use common\models\Realty;
    use yii\filters\AccessControl;
    use yii\filters\VerbFilter;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    
    class RealtyController extends Controller{
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'actions' => [
                                'index',
                                'view'
                            ],
                            'allow'   => true,
                            'roles'   => ['?'],
                        ],
                        [
                            'actions' => ['create'],
                            'allow'   => true,
                            'roles'   => ['registeredUser'],
                        ],
                        [
                            'actions' => [
                                'update',
                                'delete'
                            ],
                            'allow'   => true,
                            'roles'   => [
                                'registeredUser',
                                'manager'
                            ],
                        ],
                    ],
                ],
                'verbs'  => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
            ];
        }
        
        public function actionIndex(){
            return $this->render('index');
        }
        
        public function actionView($id){
            return $this->render('view', ['id' => $id]);
        }
        
        public function actionCreate(){
            return $this->render('create');
        }
        
        public function actionUpdate($id){
            return $this->render('update', ['id' => $id]);
        }
        
        public function actionDelete($id){
        }
        
        protected function findModel($id){
            $model = Realty::findOne($id);
            if(is_null($model)){
                throw new NotFoundHttpException('Realty not found...');
            }
            
            return $model;
        }
    }