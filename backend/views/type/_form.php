<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\AdType|\common\models\BuildingType
     */
    use common\models\Country;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\ArrayHelper;

    $country = ArrayHelper::map(Country::find()
                                       ->select(['id', 'name'])
                                       ->all(), 'id', 'name');
    if(count($country)==0){
        return Yii::$app->controller->redirect(['/type/country/create']);
    }
?>

<?php $form = ActiveForm::begin(); ?>
    <div class="container">
        <?php foreach($model::getAttrib('create') as $attr): ?>
            <?= $attr == 'country_id' ? $form->field($model, $attr)
                                             ->dropDownList($country) : $form->field($model, $attr) ?>
        <?php endforeach; ?>
        <?= Html::submitButton('Save') ?>
    </div>
<?php ActiveForm::end(); ?>