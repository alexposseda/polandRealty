<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\AdType|\common\models\BuildingType
     */

    $this->title = Yii::t('app', 'Create').' '.Yii::t('app', ucfirst(substr($model::className(), strripos($model::className(), '\\') + 1)));
?>

<?= $this->render('_form', ['model' => $model]) ?>

