<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\forms\RealtyForm
     */
    use common\models\AdType;
    use common\models\BuildingType;
    use common\models\Country;
    use common\models\forms\ContactForm;
    use common\models\PropertyType;
    use common\widgets\MapWidget\FormMapWidget;
    use frontend\assets\RealtyFormAsset;
    use macgyer\yii2materializecss\lib\Html;
    use macgyer\yii2materializecss\widgets\form\ActiveForm;
    use yii\helpers\ArrayHelper;

    $advertingType = ArrayHelper::map(AdType::find()
                                            ->select(['id', 'title'])
                                            ->all(), 'id', 'title');

    $realtyType = ArrayHelper::map(BuildingType::find()
                                               ->select(['id', 'title'])
                                               ->all(), 'id', 'title');
    $propertyType = ArrayHelper::map(PropertyType::find()
                                                 ->select(['id', 'title'])
                                                 ->all(), 'id', 'title');

    $country = ArrayHelper::map(Country::find()
                                       ->select(['id', 'name'])
                                       ->all(), 'id', 'name');
    $contact = new ContactForm();
    if(!$model->realty->isNewRecord){
        $tmp = json_decode($model->realty->contact);
        $contact->attributes = $tmp;
    }

    if($model->realty->isNewRecord){
        $centerMap = Yii::$app->params['mapConfig']['center'];
        $zoom = Yii::$app->params['mapConfig']['zoom'];
    }else{
        $coord = explode(';', $model->location->coordinates);
        $centerMap = [
            'lat' => $coord[0] * 1,
            'lng' => $coord[1] * 1
        ];
        $zoom = 18;
    }

    RealtyFormAsset::register($this);
?>
<div class="section grey lighten-3">
    <div class="container">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'filter']]) ?>
        <div class="row no-margin-bottom">
            <div class="input-field col s12 m4 l4">
                <label class="label" for="form-ad-type"><?= Yii::t('app', 'Ad Type') ?></label>
                <?= $form->field($model->realty, 'ad_type_id')
                         ->dropDownList($advertingType, ['prompt' => Yii::t('info', 'Select adverting type'), 'id' => "form-ad-type"])
                         ->label(false) ?>
            </div><!--Ad Type-->
            <div class="input-field col s12 m4 l4">
                <label class="label" for="form-realty-type"><?= Yii::t('app', 'Building Type') ?></label>
                <?= $form->field($model->realty, 'building_type_id')
                         ->dropDownList($realtyType, ['prompt' => Yii::t('info', 'Select realty type'), 'id' => "form-realty-type"])
                         ->label(false) ?>
            </div><!--Building Type-->
            <div class="input-field col s12 m4 l4">
                <label class="label" for="form-property-type"><?= Yii::t('app', 'Property Type') ?></label>
                <?= $form->field($model->realty, 'property_type_id')
                         ->dropDownList($propertyType, ['prompt' => Yii::t('info', 'Select property type'), 'id' => "form-property-type"])
                         ->label(false) ?>
            </div><!--Property Type-->
        </div>
        <div class="row no-margin-bottom">
            <div class="col s12 m4 l2">
                <p class="label"><?= Yii::t('app', 'Price') ?></p>
                <div class="input-field no-padding-left">
                    <?= $form->field($model->realty, 'price')
                             ->input('number', ['placeholder' => "pln"])
                             ->label(false) ?>
                </div>
            </div><!--Price-->
            <div class="col s12 m4 l2">
                <p class="label"><?= Yii::t('app', 'Area') ?></p>
                <div class="input-field no-padding-left">
                    <?= $form->field($model->realty, 'area')
                             ->input('number', ['placeholder' => "m2"])
                             ->label(false) ?>
                </div>
            </div><!--Area-->
            <div class="col s12 m4 l2">
                <p class="label"><?= Yii::t('app', 'Floors Count') ?></p>
                <div class="input-field no-padding-left">
                    <?= $form->field($model->realty, 'floors_count')
                             ->input('number')
                             ->label(false) ?>
                </div>
            </div><!--Floor Count-->
            <div class="col s12 m4 l2">
                <p class="label"><?= Yii::t('app', 'Floor') ?></p>
                <?= $form->field($model->realty, 'floor')
                         ->input('number')
                         ->label(false) ?>
            </div><!--Floor-->
            <div class="col s12 m4 l2">
                <p class="label"><?= Yii::t('app', 'Rooms Count') ?></p>
                <?= $form->field($model->realty, 'rooms_count')
                         ->input('number')
                         ->label(false) ?>
            </div><!--Rooms Count-->
        </div>
        <div class="row no-margin-bottom">
            <div class="col l12">
                <p class="label"><?= Yii::t('app', 'Description') ?></p>
                <?= $form->field($model->realty, 'description')
                         ->textarea(['rows' => '4'])
                         ->label(false) ?>
            </div>
        </div><!--Description-->
        <div class="row no-margin-bottom">
            <div class="col l3 contact">
                <p class="label center-align"><?= Yii::t('app', 'Contact') ?></p>
                <div class="">
                    <p class="label"><?= Yii::t('app', 'Name') ?></p>
                    <?= $form->field($model->contact, 'name')
                             ->textInput()
                             ->label(false) ?>
                </div><!--Name-->
                <div class="">
                    <p class="label"><?= Yii::t('app', 'Phone') ?></p>
                    <?= $form->field($model->contact, 'phone')
                             ->textInput()
                             ->label(false) ?>
                </div><!--Phone-->
                <div class="">
                    <p class="label"><?= Yii::t('app', 'Email') ?></p>
                    <?= $form->field($model->contact, 'email')
                             ->textInput()
                             ->label(false) ?>
                </div><!--Email-->
            </div><!--Contact-->

            <div class="col l5 location">
                <p class="label center-align"><?= Yii::t('app', 'Location') ?></p>
                <div class="col l12 country">
                    <label class="label" for="form-location-country"><?= Yii::t('app', 'Country') ?></label>
                    <?= $form->field($model->location, 'country_id')
                             ->dropDownList($country, ['prompt' => 'Select country', 'id' => 'form-location-country'])
                             ->label(false) ?>
                </div><!--Country-->
                <div class="col l6">
                    <p class="label"><?= Yii::t('app', 'City') ?></p>
                    <?= $form->field($model->location, 'city')
                             ->label(false) ?>
                </div><!--City-->
                <div class="col l6">
                    <p class="label"><?= Yii::t('app', 'Region') ?></p>
                    <?= $form->field($model->location, 'region')
                             ->label(false) ?>
                </div><!--Region-->
                <div class="col l12">
                    <p class="label"><?= Yii::t('app', 'Street') ?></p>
                    <?= $form->field($model->location, 'street')
                             ->label(false) ?>
                </div><!--Street-->
                <div class="col l12">
                    <p class="label"><?= Yii::t('app', 'Coordinates') ?></p>
                    <?= $form->field($model->location, 'coordinates')
                             ->textInput(['readonly' => true, 'placeholder' => Yii::t('info', 'Select location in map')])
                             ->label(false) ?>
                </div><!--Coordinates-->
            </div><!--Location-->

            <div class="col l4 map">
                <p class="label center-align"><?= Yii::t('app', 'Map') ?></p>
                <div class="" id="map">
                    <?= FormMapWidget::widget([
                                                  'mapSetting' => [
                                                      'center'       => $centerMap,
                                                      'zoom'         => $zoom,
                                                      'draggable'    => true,
                                                      'addressInpId' => 'location-street',
                                                      'coordInpId'   => 'location-coordinates'
                                                  ]
                                              ]) ?>
                </div>
            </div><!--Map-->

        </div>
        <?= Html::submitButton($model->realty->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),['class'=>'btn light-blue waves-effect waves-light']) ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
