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

<?php $form = ActiveForm::begin(); ?>
<?php if($model->formName() == 'Realty'): ?>
    <?= $this->render('realty/form', ['form' => $form, 'model' => $model]) ?>
<?php else: ?>
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
<?php endif; ?>
<?= Html::submitButton('Save') ?>
<?php ActiveForm::end(); ?>