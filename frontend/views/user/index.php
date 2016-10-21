<?php
    /**
     * @var $this         \yii\web\View
     * @var $dataProvider \yii\data\ActiveDataProvider
     * @var $searchModel  \common\models\search\RealtySearch
     */
    use yii\widgets\ListView;

?>

<?= ListView::widget([
                         'itemView'     => '_item',
                         'dataProvider' => $dataProvider,
                     ]) ?>
