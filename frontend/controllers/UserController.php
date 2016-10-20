<?php

    namespace frontend\controllers;

    use common\models\search\RealtySearch;
    use Yii;
    use yii\web\Controller;

    class UserController extends Controller{
        public function actionIndex(){
            //todo выводим список обьявлений пользователя
            $searchModel = new RealtySearch();
            $searchModel->created_by = Yii::$app->user->id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        }

        public function actionProfile(){
            //todo страница для изменения персональных данных
            $model = Yii::$app->user->identity;

            if($model->load(Yii::$app->request->post())&&$model->save()){
                return $this->goHome();
            }
            return $this->render('profile', ['model' => $model]);
        }

        public function actionView($id){
            //todo выводим информацию о пользователе
        }
    }