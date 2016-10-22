<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\forms\RealtyForm
     */

    $this->title = Yii::t('app', 'Update')
?>

<?= $this->render('_formRealty', ['model' => $model]);