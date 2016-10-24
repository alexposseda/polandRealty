<?php
    /**
     * @var $this         \yii\web\View
     * @var $dataProvider \yii\data\ActiveDataProvider
     * @var $searchModel  \common\models\search\RealtySearch
     */
    use yii\widgets\ListView;

?>
<div class="container">
    <?= ListView::widget([
                             'itemView'     => '_item',
                             'dataProvider' => $dataProvider,
                         ]) ?>
</div>
