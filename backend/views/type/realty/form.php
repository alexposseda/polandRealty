<?php
    /**
     * @var $form  \yii\bootstrap\ActiveForm
     * @var $model \common\models\Realty
     * @var $attr  string
     */
    use common\models\forms\ContactForm;
    use common\widgets\FileManagerWidget\FileManagerWidget;
    use common\models\AdType;
    use common\models\BuildingType;
    use common\models\PropertyType;
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
    $contact = new ContactForm();
    if(!$model->isNewRecord){
        $tmp = json_decode($model->contact);
        $contact->attributes = $tmp;
    }
?>
    <div class="row">
        <div class="col-lg-4"> <?= $form->field($model, 'ad_type_id')
                                        ->dropDownList($adtype, ['prompt' => 'Select adType']) ?>
        </div>
        <div class="col-lg-4"><?= $form->field($model, 'property_type_id')
                                       ->dropDownList($ptype, ['prompt' => 'Select Property type']) ?>
        </div>
        <div class="col-lg-4"><?= $form->field($model, 'building_type_id')
                                       ->dropDownList($btype, ['prompt' => 'Select Building type']) ?>
        </div>

        <div class="col-lg-3"><?= $form->field($model, 'price') ?></div>
        <div class="col-lg-3"><?= $form->field($model, 'area') ?></div>
        <div class="col-lg-2"><?= $form->field($model, 'floors_count') ?></div>
        <div class="col-lg-2"><?= $form->field($model, 'floor') ?></div>
        <div class="col-lg-2"><?= $form->field($model, 'rooms_count') ?></div>
        <div class="col-lg-12"><?= $form->field($model, 'description')
                                        ->textarea() ?></div>
    </div>

    <div class="row contact">
        <div class="col-lg-6">
            <div class="panel panel-danger">
                <span class="page-header">Contact</span>
                <div class="row panel-body">
                    <div class="col-lg-4"><?= $form->field($contact, 'name') ?></div>
                    <div class="col-lg-4"><?= $form->field($contact, 'phone') ?></div>
                    <div class="col-lg-4"><?= $form->field($contact, 'email') ?></div>
                </div>
            </div>
        </div>
    </div>


<?= Html::activeHiddenInput($model, 'gallery', ['id' => 'gallery']) ?>
<?= FileManagerWidget::widget([
                                  'uploadUrl'     => Url::to('/type/realty-upload'),
                                  'removeUrl'     => Url::to('/type/realty-remove'),
                                  'files'         => ($model->isNewRecord) ? '' : $model->gallery,
                                  'targetInputId' => 'gallery',
                                  'maxFiles'      => 10,
                                  'title'         => 'Gallery',
                              ]) ?>