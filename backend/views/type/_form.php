<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \yii\db\ActiveRecord
     */
    use common\models\Country;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\ArrayHelper;

?>
<?php if($model->formName() == 'RealtyForm'): ?>
    <?= $this->render('realty/form', ['model' => $model]) ?>
<?php else: ?>
    <?php $form = ActiveForm::begin(); ?>

    <?php foreach($model::getAttrib('create') as $attr): ?>
        <?php if($attr == 'country_id'): ?>
            <?php $country = ArrayHelper::map(Country::find()
                                                     ->select(['id', 'name'])
                                                     ->all(), 'id', 'name'); ?>
            <?= $form->field($model, $attr)
                     ->dropDownList($country, ['prompt' => 'Select country']) ?>
            <?php continue;
        endif; ?>

        <?= $form->field($model, $attr) ?>
    <?php endforeach; ?>
    <?= Html::submitButton('Save') ?>
    <?php ActiveForm::end(); ?>

<?php endif; ?>
