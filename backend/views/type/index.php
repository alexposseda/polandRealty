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

    $this->title = ucfirst($nameModel);

    $gridview = GridView::widget(['dataProvider' => $dataProvider, 'filterModel' => $filterModel, 'columns' => $columns,]);
?>

<div class="row">
    <?php if($nameModel == 'realty'): ?>
        <div class="col-lg-10 col-lg-offset-2">
            <?= Html::a('Create', ['type/'.$nameModel.'/create'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-2 filter">
            <?= $this->render('realty/realtyFilter', ['searchModel' => $filterModel]) ?>
        </div>
        <div class="col-lg-10">
            <?= $gridview ?>
        </div>
    <?php else: ?>
        <div class="col-lg-12">
            <?= Html::a('Create', ['type/'.$nameModel.'/create'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-12">
            <?= $gridview ?>
        </div>
    <?php endif ?>
</div>
