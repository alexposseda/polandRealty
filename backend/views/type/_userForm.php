<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\User
     */
    use common\models\UserIdentity;
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Html;
    use yii\helpers\ArrayHelper;

    $roles = ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name');
    $curRole = key(Yii::$app->authManager->getRolesByUser($model->id));

    $this->title = Yii::t('app', 'Update').' '.$model->name;
?>
    <h1><?= $this->title ?></h1>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model, 'email')
         ->textInput(['disabled' => true]) ?>
<?= $form->field($model, 'name')
         ->textInput(['disabled' => true]) ?>
<?= $form->field($model, 'phone')
         ->textInput(['disabled' => true]) ?>

<?= Html::label(Yii::t('app', 'Role'), 'role') ?>
<?= Html::dropDownList('role', $curRole, $roles, ['class' => 'form-control']) ?>

<?= $form->field($model, 'status')
         ->dropDownList([
                            UserIdentity::STATUS_ACTIVE  => 'Active',
                            UserIdentity::STATUS_DELETED => 'Inactive',
                        ]) ?>
<?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-warning']) ?>

<?php ActiveForm::end() ?>