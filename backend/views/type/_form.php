<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\AdType|\common\models\BuildingType
     */
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;

?>

<?php $form = ActiveForm::begin(); ?>
    <div class="container">
        <?= $form->field($model, 'title') ?>
        <?= Html::submitButton('Save') ?>
    </div>
<?php ActiveForm::end(); ?>