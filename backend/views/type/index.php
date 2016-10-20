<?php
    /**
     * @var $this         \yii\web\View
     * @var $dataProvider \yii\data\ActiveDataProvider
     * @var $filterModel  \common\models\search\RealtySearch
     * @var $nameModel    string
     * @var $columns      string
     */
    use yii\bootstrap\Html;
    use yii\grid\GridView;

    $nameModel = substr($nameModel, strripos($nameModel, '\\'));

    $this->title = Yii::t('app', ucfirst($nameModel));

    $gridview = GridView::widget(['dataProvider' => $dataProvider, 'columns' => $columns,]);
    $createBtn = Html::a(Yii::t('app', 'Create'), ['type/'.$nameModel.'/create'], ['class' => 'btn btn-primary']);
?>

<div class="row">
    <div class="col-lg-12">
        <?= $createBtn ?>
    </div>
    <div class="col-lg-12 table-responsive">
        <?= $gridview ?>
    </div>
</div>
