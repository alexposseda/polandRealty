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
    $adtypeList = ArrayHelper::map(AdType::find()
                                         ->all(), 'id', 'title');

    IonRangeAsset::register($this);

?>
<br>
<?php Pjax::begin(['id' => 'filter']) ?>
<?php $realtyForm = ActiveForm::begin([
                                          'method' => 'GET',
                                          'action' => ['type/index', 'nameModel' => 'realty'],
                                          'id'     => 'form-realty',
                                      ]); ?>
<div class="row">
    <div class="col-lg-12">
        <?= Html::activeDropDownList($searchModel, 'ad_type_id', ArrayHelper::map(AdType::find()
                                                                                        ->all(), 'id', 'title'),
                                     ['prompt' => Yii::t('app', 'Select').' '.Yii::t('app', 'AdType')]) ?>
    </div>
    <div class="col-lg-12">
        <?= Html::activeDropDownList($searchModel, 'property_type_id', ArrayHelper::map(PropertyType::find()
                                                                                                    ->all(), 'id', 'title'),
                                     ['prompt' => Yii::t('app', 'Select').' '.Yii::t('app', 'PropertyType')]) ?>
    </div>
    <div class="col-lg-12">
        <?= Html::activeDropDownList($searchModel, 'building_type_id', ArrayHelper::map(BuildingType::find()
                                                                                                    ->all(), 'id', 'title'),
                                     ['prompt' => Yii::t('app', 'Select').' '.Yii::t('app', 'BuildingType')]) ?>
    </div>

    <div class="input-field no-marg-top col-lg-10 col-lg-offset-1">
        <div class="row">
            <div class="col-lg-6">
                <?= $realtyForm->field($searchModel, 'priceFrom') ?>
            </div>
            <div class="col-lg-6">
                <?= $realtyForm->field($searchModel, 'priceTo') ?>
            </div>
        </div>
    </div>
    <div class="input-field no-marg-top col-lg-10 col-lg-offset-1">
        <div class="row">
            <div class="col-lg-6">
                <?= $realtyForm->field($searchModel, 'areaFrom') ?>
            </div>
            <div class="col-lg-6">
                <?= $realtyForm->field($searchModel, 'areaTo') ?>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <?= Html::label(Yii::t('app', 'PostalCode'), 'realtysearch-postalcode') ?>
        <?= Html::activeTextInput($searchModel, 'postalCode') ?>
    </div>
    <div class="col-lg-12">
        <?= Html::label(Yii::t('app', 'Country'), 'realtysearch-countryname') ?>
        <?= Html::activeTextInput($searchModel, 'countryName') ?>
    </div>
    <div class="col-lg-12">
        <?= Html::label(Yii::t('app', 'City'), 'realtysearch-cityname') ?>
        <?= Html::activeTextInput($searchModel, 'cityName') ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <?= Html::submitButton(Yii::t('app', 'Select'), ['class' => 'btn red fullWidth waves-effect waves-light']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<?php Pjax::end() ?>
