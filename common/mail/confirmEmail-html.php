<?php
    use yii\helpers\Html;
    
    /* @var $this yii\web\View */
    /* @var $user common\models\UserIdentity */
    
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hello <?= Html::encode($user->name) ?>,</p>
    
    <p>Follow the link below to confirm your email:</p>
    
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>