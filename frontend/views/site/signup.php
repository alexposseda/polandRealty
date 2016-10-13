<?php
    
    /* @var $this yii\web\View */
    /* @var $form yii\bootstrap\ActiveForm */
    /* @var $model \frontend\models\SignupForm */
    
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
    
    $this->title                   = 'Signup';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>Please fill out the following fields to signup:</p>
    
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            
            <?= $form->field($model, 'email')->input('email', ['autofocus' => true]) ?>
            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'phone') ?>
            <?= $form->field($model, 'password_repeat')
                     ->passwordInput()->label('Password') ?>
            <?= $form->field($model, 'password')
                     ->passwordInput()->label('Password Confirm') ?>
            
            <div class="form-group">
                <?= Html::submitButton('Signup', [
                    'class' => 'btn btn-primary',
                    'name'  => 'signup-button'
                ]) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
