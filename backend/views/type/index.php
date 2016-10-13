<?php
    /**
     * @var $this         \yii\web\View
     * @var $dataProvider \yii\data\ActiveDataProvider
     * @var $nameModel    string
     * @var $columns      string
     */
    use yii\bootstrap\Html;
    use yii\grid\GridView;

    $nameModel = substr($nameModel, strripos($nameModel, '\\'));

    $this->title = ucfirst($nameModel);
?>
<div>
    <?= Html::a('Create', ['type/'.$nameModel.'/create'], ['class' => 'btn btn-primary']) ?>
</div>
<?= GridView::widget(['dataProvider' => $dataProvider, 'columns' => $columns,]) ?>
