<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\User
     */
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\ArrayHelper;

    $roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
    $curRole = key(Yii::$app->authManager->getRolesByUser($model->id));

    $this->title = 'Profile '.$model->name;
?>
<h1><?= $this->title ?></h1>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email')
         ->textInput(['disabled' => true]) ?>
<?= $form->field($model, 'name')
         ->textInput() ?>
<?= $form->field($model, 'phone')
         ->textInput() ?>
<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-warning']) ?>

<?php ActiveForm::end() ?>
<?= Html::a(Yii::t('app', 'Change Password'), ['site/request-password-reset'], ['class' => 'btn btn-info']) ?>
