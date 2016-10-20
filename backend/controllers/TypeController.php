<?php

    namespace backend\controllers;

    use backend\models\RealtyGallery;
    use common\models\forms\ContactForm;
    use common\models\forms\RealtyForm;
    use common\models\Location;
    use common\models\Realty;
    use common\models\search\RealtySearch;
    use Yii;
    use yii\alexposseda\fileManager\actions\RemoveAction;
    use yii\alexposseda\fileManager\actions\UploadAction;
    use yii\base\Model;
    use yii\bootstrap\Html;
    use yii\data\ActiveDataProvider;
    use yii\db\ActiveRecord;
    use yii\filters\AccessControl;
    use yii\filters\VerbFilter;
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
         * @inheritdoc
         */
        public function behaviors(){
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ],
                    ],
                ],
                'verbs'  => [
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
            ];
        }

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
                [
                    'content' => function($model) use ($nameModel){
                        $res = Html::a(Yii::t('app', 'Update'), ['type/'.$nameModel.'/update/'.$model->id], ['class' => 'btn btn-info']);
                        $res .= ' ';
                        $res .= Html::a(Yii::t('app', 'Delete'), ['type/'.$nameModel.'/delete/'.$model->id], ['class' => 'btn btn-danger']);

                        return $res;
                    },
                ],
            ];
            array_splice($columns, 1, 0, $mod::getAttrib('full'));

            $filterModel = null;
            if($nameModel == 'realty'){
                $filterModel = new RealtySearch();

                $dataProvider = $filterModel->search(Yii::$app->request->queryParams);
            }

            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'filterModel'  => $filterModel,
                'nameModel'    => $nameModel,
                'columns'      => $columns,
            ]);
        }

        public function actionCreate($nameModel){
            $mod = $this->getModel($nameModel);

            /** @var ActiveRecord $model */
            $model = new $mod();
            

            if($model->load(Yii::$app->request->post()) && $model->save()){
                return $this->redirect([$nameModel]);
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
                return $this->redirect([$nameModel]);
            }

            return $this->render('update', ['model' => $model]);
        }

        public function actionDelete($nameModel, $id){
            $mod = $this->getModel($nameModel);
            /** @var ActiveRecord $mod */
            $mod::findOne($id)
                ->delete();

            return $this->redirect([$nameModel]);
        }

        public function getModel($nameModel){
            if(class_exists('common\models\\'.ucfirst($nameModel))){
                return 'common\models\\'.ucfirst($nameModel);
            }
            throw new NotFoundHttpException('The requested class does not exist.');
        }
        
        public function beforeAction($action){
            $nameModel = Yii::$app->request->get('nameModel');
            if($nameModel == 'realty'){
                throw new NotFoundHttpException('Page Not Found');
            }
            return true;
        }
    }