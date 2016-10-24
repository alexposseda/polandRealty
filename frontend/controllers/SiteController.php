<?php
    namespace frontend\controllers;
    
    use common\components\Notify;
    use common\models\search\RealtySearch;
    use frontend\models\ConfirmEmailModel;
    use Yii;
    use yii\base\InvalidParamException;
    use yii\web\BadRequestHttpException;
    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;
    use common\models\LoginForm;
    use frontend\models\PasswordResetRequestForm;
    use frontend\models\ResetPasswordForm;
    use frontend\models\SignupForm;
    
    /**
     * Site controller
     */
    class SiteController extends Controller{
        /**
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'only'  => [
                        'logout',
                        'signup'
                    ],
                    'rules' => [
                        [
                            'actions' => ['signup'],
                            'allow'   => true,
                            'roles'   => ['?'],
                        ],
                        [
                            'actions' => ['logout'],
                            'allow'   => true,
                            'roles'   => ['@'],
                        ],
                    ],
                ],
                'verbs'  => [
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'logout' => ['post'],
                    ],
                ],
            ];
        }
        
        /**
         * @inheritdoc
         */
        public function actions(){
            return [
                'error'   => [
                    'class' => 'yii\web\ErrorAction',
                ],
                'captcha' => [
                    'class'           => 'yii\captcha\CaptchaAction',
                    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                ],
            ];
        }
        
        /**
         * Displays homepage.
         *
         * @return mixed
         */
        public function actionIndex(){

            $searchModel = new RealtySearch();
            $dataProvider = $searchModel->search();
            $dataProvider->pagination = ['pageSize' => 4,];
    
            return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }
        
        /**
         * Logs in a user.
         *
         * @return mixed
         */
        public function actionLogin(){
            if(!Yii::$app->user->isGuest){
                return $this->goHome();
            }
            
            $model = new LoginForm();
            if($model->load(Yii::$app->request->post()) && $model->login()){
                return $this->goBack();
            }else{
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
        
        /**
         * Logs out the current user.
         *
         * @return mixed
         */
        public function actionLogout(){
            Yii::$app->user->logout();
            
            return $this->goHome();
        }
        
        /**
         * Signs user up.
         *
         * @return mixed
         */
        public function actionSignup(){
            $model = new SignupForm();
            if($model->load(Yii::$app->request->post())){
                if($model->signup()){
                    return $this->goHome();
                }
            }
            
            return $this->render('signup', [
                'model' => $model,
            ]);
        }
        
        /**
         * Requests password reset.
         *
         * @return mixed
         */
        public function actionRequestPasswordReset(){
            $model = new PasswordResetRequestForm();
            if($model->load(Yii::$app->request->post()) && $model->validate()){
                if($model->sendEmail()){
                    Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                    
                    return $this->goHome();
                }else{
                    Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
                }
            }
            
            return $this->render('requestPasswordResetToken', [
                'model' => $model,
            ]);
        }
        
        /**
         * Resets password.
         *
         * @param string $token
         *
         * @return mixed
         * @throws BadRequestHttpException
         */
        public function actionResetPassword($token){
            try{
                $model = new ResetPasswordForm($token);
            }catch(InvalidParamException $e){
                throw new BadRequestHttpException($e->getMessage());
            }
            
            if($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()){
                Yii::$app->session->setFlash('success', 'New password was saved.');
                
                return $this->goHome();
            }
            
            return $this->render('resetPassword', [
                'model' => $model,
            ]);
        }
        
        /**
         * Confirm email
         *
         * @param string $token
         *
         * @return \yii\web\Response
         * @throws BadRequestHttpException
         */
        public function actionConfirmEmail($token){
            try{
                $model = new ConfirmEmailModel($token);
            }catch(InvalidParamException $e){
                throw new BadRequestHttpException($e->getMessage());
            }
            
            $model->confirmEmail();
            
            return $this->goHome();
        }
        
        public function beforeAction($action){
            Notify::showMessages();
            
            return parent::beforeAction($action);
        }
    }
