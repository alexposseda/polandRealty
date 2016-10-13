<?php

    namespace backend\controllers;

    use Yii;
    use yii\bootstrap\Html;
    use yii\data\ActiveDataProvider;
    use yii\db\ActiveRecord;
    use yii\grid\SerialColumn;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;

    /**
     * Class AdminController
     * CRUD for ad_type | building_type
     *
     * @package backend\controllers
     */
    class TypeController extends Controller{

        /**
         * @param $nameModel string
         *
         * @return string
         */
        public function actionIndex($nameModel){
            $mod = $this->getModel($nameModel);

            /** @var ActiveRecord $mod */
            $query = $mod::find();
            $dataProvider = new ActiveDataProvider(['query' => $query]);

            $columns = [
                ['class' => SerialColumn::className()],
                'title',
                'created_at:datetime',
                'updated_at:datetime',
                [
                    'content' => function($model) use ($nameModel){
                        $res = Html::a('Update', ['update', 'nameModel' => $nameModel, 'id' => $model->id], ['class' => 'btn btn-info']);
                        $res .= ' ';
                        $res .= Html::a('Delete', ['update', 'nameModel' => $nameModel, 'id' => $model->id,], ['class' => 'btn btn-danger']);

                        return $res;
                    },
                ],
            ];

            return $this->render('index', ['dataProvider' => $dataProvider, 'nameModel' => $nameModel, 'columns' => $columns]);
        }

        public function actionCreate($nameModel){
            $mod = $this->getModel($nameModel);

            /** @var ActiveRecord $model */
            $model = new $mod();

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['index', 'nameModel' => $nameModel]);
            }

            return $this->render('create', ['model' => $model]);
        }

        public function actionUpdate($nameModel, $id){
            $mod = $this->getModel($nameModel);

            /** @var ActiveRecord $mod */
            $model = $mod::findOne($id);
            if(!$model){
                throw new NotFoundHttpException('The requested page does not exist.');
            }

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect(['index', 'nameModel' => $nameModel]);
            }

            return $this->render('update', ['model' => $model]);
        }

        public function getModel($nameModel){
            if(class_exists('common\models\\'.ucfirst($nameModel))){
                return 'common\models\\'.ucfirst($nameModel);
            }
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }