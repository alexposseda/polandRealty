<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\forms\RealtyForm
     */

    $this->title = Yii::t('app','Create')
?>

<?= $this->render('_formRealty', ['model' => $model]);