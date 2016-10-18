<?php
    /**
     * @var  $this        \yii\web\View
     * @var  $searchModel \common\models\search\RealtySearch
     */
    use backend\assets\IonRangeAsset;
    use common\models\AdType;
    use common\models\BuildingType;
    use common\models\PropertyType;
    use common\widgets\SliderWidget\SliderWidget;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\ArrayHelper;
    use yii\widgets\Pjax;

    $priceInterval = $searchModel->getInterval('price');
    $areaInterval = $searchModel->getInterval('area');
    IonRangeAsset::register($this);

?>
<br>
<?php Pjax::begin(['id' => 'filter']) ?>
<?php $houseForm = ActiveForm::begin([
                                         'method' => 'GET',
                                         'action' => ['type/index','nameModel'=>'realty'],
                                         'id'     => 'form-realty'
                                     ]); ?>
<div class="row">
    <div class="col-lg-12">
        <?= Html::activeDropDownList($searchModel, 'ad_type_id', ArrayHelper::map(AdType::find()
                                                                                        ->all(), 'id', 'title')) ?>
    </div>
    <div class="col-lg-12">
        <?= Html::activeDropDownList($searchModel, 'property_type_id', ArrayHelper::map(PropertyType::find()
                                                                                                    ->all(), 'id', 'title')) ?>
    </div>
    <div class="col-lg-12">
        <?= Html::activeDropDownList($searchModel, 'building_type_id', ArrayHelper::map(BuildingType::find()
                                                                                                    ->all(), 'id', 'title')) ?>
    </div>

    <div class="input-field no-marg-top col-sm-10 col-sm-offset-1">
        <?= SliderWidget::widget([
                                     'label'     => 'Price, pln',
                                     'model'     => $searchModel,
                                     'attribute' => 'price',
                                     'postfix'   => ' pln',
                                     'interval'  => $priceInterval
                                 ]) ?>
    </div>
    <div class="input-field no-marg-top col-sm-10 col-sm-offset-1">
        <?= SliderWidget::widget([
                                     'label'     => 'Area, m2',
                                     'model'     => $searchModel,
                                     'attribute' => 'area',
                                     'postfix'   => ' m2',
                                     'interval'  => $areaInterval
                                 ]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <?= Html::submitButton('Подобрать', ['class' => 'btn red fullWidth waves-effect waves-light']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<?php Pjax::end() ?>
