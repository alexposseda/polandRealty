<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\AdType|\common\models\BuildingType
     */
    $this->title = 'Update '.$model->title;
?>

<?= $this->render('_form', ['model' => $model]) ?>