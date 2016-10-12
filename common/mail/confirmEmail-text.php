<?php
    
    /* @var $this yii\web\View */
    /* @var $user common\models\UserIdentity */
    
    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/confirm-email', 'token' => $user->password_reset_token]);
?>
    Hello <?= $user->name ?>,
    
    Follow the link below to confirm your email:

<?= $resetLink ?>