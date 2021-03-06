<?php

namespace frontend\controllers;

use common\models\forms\ContactForm;
use common\models\forms\RealtyForm;
use common\models\Realty;
use common\models\search\RealtySearch;
use frontend\models\RealtyGallery;
use Yii;
use yii\alexposseda\fileManager\actions\UploadAction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class RealtyController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'view',
                        ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create', 'gallery-upload', 'gallery-remove'],
                        'allow' => true,
                        'roles' => ['registeredUser'],
                    ],
                    [
                        'actions' => [
                            'update',
                            'delete',
                        ],
                        'allow' => true,
                        'roles' => [
                            'registeredUser',
                            'manager',
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'gallery-upload' => [
                'class' => UploadAction::className(),
                'uploadPath' => 'gallery',
                'sessionEnable' => true,
                'uploadModel' => new RealtyGallery([
                    'validationRules' => [
                        'extensions' => 'jpg, png'
                    ]
                ])
            ],
            'gallery-remove'    => [
                'class' => '\yii\alexposseda\fileManager\actions\RemoveAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new RealtySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 16,];

        return $this->render('index', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $contact = json_decode($model->contact);

        return $this->render('view', ['model' => $model, 'contact' => $contact]);
    }

    public function actionCreate()
    {
        $model = new RealtyForm(new Realty());

        if ($model->load() && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = new RealtyForm($this->findModel($id));

        if ($model->load() && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = new RealtyForm($this->findModel($id));
        $model->realty->delete();
        return $this->goHome();
    }

    protected function findModel($id)
    {
        $model = Realty::findOne($id);
        if (is_null($model)) {
            throw new NotFoundHttpException('Realty not found...');
        }

        return $model;
    }
}