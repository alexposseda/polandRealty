<?php
    /**
     * @var $this         \yii\web\View
     * @var $searchModel  \common\models\search\RealtySearch
     */
    
    use common\models\AdType;
    use common\models\BuildingType;
    use common\models\Country;
    use common\models\Location;
    use common\models\PropertyType;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\ArrayHelper;
    
    $realtyType    = ArrayHelper::map(PropertyType::find()
                                                  ->all(), 'id', 'title');
    $buildingType  = ArrayHelper::map(BuildingType::find()
                                                  ->all(), 'id', 'title');
    $advertingType = ArrayHelper::map(AdType::find()
                                            ->all(), 'id', 'title');
    $country       = ArrayHelper::map(Country::find()
                                             ->all(), 'id', 'name');
    
    $region = ArrayHelper::map(Location::find()
                                       ->all(), 'region', 'region');
    
    $action = ($action) ? $action : 'realty/index';
    if(empty(Yii::$app->request->get('RealtySearch')['property_type_id'])){
        $showProperty = true;
    }
?>
<div class="section grey lighten-3">
    <div class="container">
        <?php $filter = ActiveForm::begin([
                                              'action'  => [$action],
                                              'method' => 'get',
                                              'options' => [
                                                  'data-pjax' => true,
                                                  'class'     => 'filter filter-main',
                                                  'id'        => 'filter'
                                              ]
                                          ]) ?>
        <div class="row no-margin">
            
            <div class="col s12 m10 l10">
                <div class="row no-margin-bottom">
                    <?php if($showProperty): ?>
                        <div class="col s12 m8 l8">
                            <div class="row no-margin-bottom">
                                <div class="input-field col s12 m4 l4">
                                    <label class="label" for="filter-realty-type"><?= Yii::t('app', 'Property Type') ?></label>
                                    <?= $filter->field($searchModel, 'property_type_id')
                                               ->dropDownList($realtyType, [
                                                   'prompt' => Yii::t('info', 'Select realty type'),
                                                   'id'     => "filter-realty-type"
                                               ])
                                               ->label(false) ?>
                                </div><!--Property Type-->
                                <div class="input-field col s12 m4 l4">
                                    <label class="label" for="filter-realty-type"><?= Yii::t('app', 'Building Type') ?></label>
                                    <?= $filter->field($searchModel, 'building_type_id')
                                               ->dropDownList($buildingType, [
                                                   'prompt' => Yii::t('info', 'Select building type'),
                                                   'id'     => "filter-realty-type"
                                               ])
                                               ->label(false) ?>
                                </div><!--Building Type-->
                                <div class="input-field col s12 m4 l4">
                                    <label class="label" for="filter-ad-type"><?= Yii::t('app', 'Ad Type') ?></label>
                                    <?= $filter->field($searchModel, 'ad_type_id')
                                               ->dropDownList($advertingType, [
                                                   'prompt' => Yii::t('info', 'Select adverting type'),
                                                   'id'     => "filter-ad-type"
                                               ])
                                               ->label(false) ?>
                                </div><!--Ad Type-->
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="input-field col s12 m4 l4">
                            <label class="label" for="filter-realty-type"><?= Yii::t('app', 'Building Type') ?></label>
                            <?= $filter->field($searchModel, 'building_type_id')
                                       ->dropDownList($buildingType, [
                                           'prompt' => Yii::t('info', 'Select building type'),
                                           'id'     => "filter-realty-type"
                                       ])
                                       ->label(false) ?>
                        </div><!--Building Type-->
                        <div class="input-field col s12 m4 l4">
                            <label class="label" for="filter-ad-type"><?= Yii::t('app', 'Ad Type') ?></label>
                            <?= $filter->field($searchModel, 'ad_type_id')
                                       ->dropDownList($advertingType, [
                                           'prompt' => Yii::t('info', 'Select adverting type'),
                                           'id'     => "filter-ad-type"
                                       ])
                                       ->label(false) ?>
                        </div><!--Ad Type-->
                    <?php endif; ?>
                    <div class="col s12 m4 l4">
                        <div class="row no-margin">
                            <p class="label"><?= Yii::t('app', 'Price') ?></p>
                            <div class="input-field col s6 no-padding-left">
                                <?= $filter->field($searchModel, 'priceFrom')
                                           ->input('number', [
                                               'id'          => "filter-price-min",
                                               'placeholder' => "min"
                                           ])
                                           ->label(false) ?>
                            </div>
                            <div class="input-field col s6 no-padding-right">
                                <?= $filter->field($searchModel, 'priceTo')
                                           ->input('number', [
                                               'id'          => "filter-price-max",
                                               'placeholder' => "max"
                                           ])
                                           ->label(false) ?>
                            </div>
                        </div>
                    </div><!--Price-->
                </div>
                <div class="row no-margin-bottom">
                    <div class="input-field col s12 m8 l8 relative">
                        <label class="label" for="filter-location">Location</label>
                        <input type="text" id="filter-location" class="validate" placeholder="Location">
                        <a href="#modal-detail-location" class="btn-floating input-btn tooltipped modal-trigger" id="location-btn"
                           data-position="right" data-tooltip="Detail Location">
                            <i class="material-icons">my_location</i>
                        </a>
                    </div>
                    <div class="col s12 m4 l4">
                        <div class="row no-margin">
                            <p class="label"><?= Yii::t('app', 'Area') ?></p>
                            <div class="input-field col s6 no-padding-left">
                                <?= $filter->field($searchModel, 'areaFrom')
                                           ->input('number', [
                                               'id'          => "filter-area-min",
                                               'placeholder' => "min"
                                           ])
                                           ->label(false) ?>
                            </div>
                            <div class="input-field col s6 no-padding-right">
                                <?= $filter->field($searchModel, 'areaTo')
                                           ->input('number', [
                                               'id'          => "filter-area-max",
                                               'placeholder' => "max"
                                           ])
                                           ->label(false) ?>                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m2 l2 submit-btn-wrap">
                <?= Html::submitButton('<i class="material-icons">search</i>'.Yii::t('app', 'Search'),
                                       ['class' => "btn light-blue waves-effect waves-light full"]) ?>
            </div>
        </div>
        <!-- modals start-->
        <div id="modal-detail-location" class="modal">
            <div class="modal-content">
                <a href="#!" class="modal-action modal-close modal-close-btn"><i class="material-icons">close</i></a>
                <h4><?= Yii::t('info', 'Detail Location') ?></h4>
                <div class="input-field">
                    <label for="filter-country" class="label"><?= Yii::t('info', 'Select country') ?></label>
                    <?= $filter->field($searchModel, 'country_id')
                               ->dropDownList($country, [
                                   'prompt' => Yii::t('info', 'Select country'),
                                   'id'     => 'filter-country'
                               ])
                               ->label(false) ?>
                </div>
                <div class="input-field">
                    <label class="label" for="filter-postal-code"><?= Yii::t('app', 'Postal Code') ?></label>
                    <?= $filter->field($searchModel, 'postalCode')
                               ->textInput([
                                               'id'          => 'filter-postal-code',
                                               'placeholder' => '102541'
                                           ])
                               ->label(false) ?>
                </div>
                <div class="input-field">
                    <label for="filter-region" class="label"><?= Yii::t('info', 'Select a region') ?></label>
                    <?= $filter->field($searchModel, 'region')
                               ->dropDownList($region, [
                                   'prompt'   => Yii::t('info', 'Select a region'),
                                   'id'       => 'filter-region',
                                   'disabled' => true
                               ])
                               ->label(false) ?>
                </div>
                <div class="input-field">
                    <label class="label" for="filter-city"><?= Yii::t('app', 'City') ?></label>
                    <?= $filter->field($searchModel, 'city')
                               ->textInput([
                                               'id'          => 'filter-city',
                                               'placeholder' => 'London'
                                           ])
                               ->label(false) ?>
                </div>
                <div class="input-field">
                    <label class="label" for="filter-street"><?= Yii::t('app', 'Street') ?></label>
                    <?= $filter->field($searchModel, 'street')
                               ->textInput([
                                               'id'          => 'filter-street',
                                               'placeholder' => 'Baker street'
                                           ])
                               ->label(false) ?>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat"><?= Yii::t('app', 'Apply') ?></a>
            </div>
        </div>
        <!-- modals end-->
        <?php ActiveForm::end() ?>
    </div>
</div>
