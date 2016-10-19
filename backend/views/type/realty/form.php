<?php
    /**
     * @var $form  \yii\bootstrap\ActiveForm
     * @var $model \common\models\RealtyForm
     * @var $attr  string
     */
    use common\widgets\MapWidget\FormMapWidget;
    use common\models\Country;
    use common\widgets\FileManagerWidget\FileManagerWidget;
    use common\models\AdType;
    use common\models\BuildingType;
    use common\models\PropertyType;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;

    $adtype = ArrayHelper::map(AdType::find()
                                     ->select(['id', 'title'])
                                     ->all(), 'id', 'title');
    $ptype = ArrayHelper::map(PropertyType::find()
                                          ->select(['id', 'title'])
                                          ->all(), 'id', 'title');
    $btype = ArrayHelper::map(BuildingType::find()
                                          ->select(['id', 'title'])
                                          ->all(), 'id', 'title');

    if($model->realty->isNewRecord){
        $centerMap = Yii::$app->params['mapConfig']['center'];
        $zoom = Yii::$app->params['mapConfig']['zoom'];
    }else{
        $coord = explode(';', $model->location->coordinates);
        $centerMap = [
            'lat' => $coord[0] * 1,
            'lng' => $coord[1] * 1,
        ];
        $zoom = 18;
    }

?>
<?php $form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-lg-4"> <?= $form->field($model->realty, 'ad_type_id')
                                    ->dropDownList($adtype, ['prompt' => 'Select adType']) ?>
    </div>
    <div class="col-lg-4"><?= $form->field($model->realty, 'property_type_id')
                                   ->dropDownList($ptype, ['prompt' => 'Select Property type']) ?>
    </div>
    <div class="col-lg-4"><?= $form->field($model->realty, 'building_type_id')
                                   ->dropDownList($btype, ['prompt' => 'Select Building type']) ?>
    </div>

    <div class="col-lg-3"><?= $form->field($model->realty, 'price') ?></div>
    <div class="col-lg-3"><?= $form->field($model->realty, 'area') ?></div>
    <div class="col-lg-2"><?= $form->field($model->realty, 'floors_count') ?></div>
    <div class="col-lg-2"><?= $form->field($model->realty, 'floor') ?></div>
    <div class="col-lg-2"><?= $form->field($model->realty, 'rooms_count') ?></div>
    <div class="col-lg-12"><?= $form->field($model->realty, 'description')
                                    ->textarea() ?></div>
</div>

<div class="row">
    <div class="col-lg-3 contact">
        <div class="panel panel-danger">
            <span class="page-header"><?= Yii::t('app', 'Contact') ?></span>
            <div class="panel-body">
                <div class=""><?= $form->field($model->contact, 'name') ?></div>
                <div class=""><?= $form->field($model->contact, 'phone') ?></div>
                <div class=""><?= $form->field($model->contact, 'email') ?></div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 location">
        <div class="panel panel-default">
            <span class="page-header"><?= Yii::t('app', 'Location') ?></span>
            <div class="panel-body">
                <div class="row">
                    <?php $country = ArrayHelper::map(Country::find()
                                                             ->select(['id', 'name'])
                                                             ->all(), 'id', 'name'); ?>
                    <div class="col-lg-12"> <?= $form->field($model->location, 'country_id')
                                                     ->dropDownList($country, ['prompt' => 'Select country']) ?></div>
                    <div class="col-lg-6"><?= $form->field($model->location, 'city') ?></div>
                    <div class="col-lg-6"><?= $form->field($model->location, 'region') ?></div>
                    <div class="col-lg-12"><?= $form->field($model->location, 'street') ?></div>
                    <div class="col-lg-12"><?= $form->field($model->location, 'coordinates')
                                                    ->textInput(['readonly' => true]) ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 map">
        <div class="map ">
            <div class="panel panel-danger" style="height: 452px">
                <?= FormMapWidget::widget([

                                              'mapSetting' => [
                                                  'center'       => $centerMap,
                                                  'zoom'         => $zoom,
                                                  'draggable'    => true,
                                                  'addressInpId' => 'location-street',
                                                  'coordInpId'   => 'location-coordinates',
                                              ],
                                          ]) ?>
            </div>
        </div>
    </div>
</div>

<?= Html::activeHiddenInput($model->realty, 'gallery', ['id' => 'gallery']) ?>
<?= FileManagerWidget::widget([
                                  'uploadUrl'     => Url::to('/type/realty-upload'),
                                  'removeUrl'     => Url::to('/type/realty-remove'),
                                  'files'         => ($model->realty->isNewRecord) ? '' : $model->realty->gallery,
                                  'targetInputId' => 'gallery',
                                  'maxFiles'      => 10,
                                  'title'         => Yii::t('app', 'Gallery'),
                              ]) ?>
<?= Html::submitButton(($model->realty->isNewRecord) ? Yii::t('app', 'Create') : Yii::t('app', 'Update'),
                       ['class' => 'btn '.(($model->realty->isNewRecord) ? 'btn-primary' : 'btn-warning')]) ?>
<?php ActiveForm::end() ?>
