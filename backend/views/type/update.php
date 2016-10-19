<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\AdType|\common\models\BuildingType
     */
    $this->title = Yii::t('app', 'Update');
?>

<?= $this->render('_form', ['model' => $model]) ?>