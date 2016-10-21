<?php
    /**
     * @var $this         \yii\web\View
     * @var $dataProvider \yii\data\ActiveDataProvider
     * @var $searchModel  \common\models\search\RealtySearch
     */
    use yii\web\View;
    use yii\widgets\ListView;
    use yii\widgets\Pjax;

    $script = <<<JS
 $('select').material_select();
// $('#realty-list').reload();

JS;

    $this->registerJs($script, View::POS_END);
?>
<?= $this->render('filterRealty', ['searchModel' => $searchModel]) ?>
<div class="section">
    <div class="container">
        <?php Pjax::begin(['id'=>'realty-list','formSelector'=>'filter']) ?>
        <?= ListView::widget([
                                 'dataProvider' => $dataProvider,
                                 'itemView'     => '_realtyItem',
                                 'layout'       => "<div class='row'>{items}</div>\n<div class='pagination-wrap'>{pager}</div>",

                                 'itemOptions' => [
                                     'tag'   => 'div',
                                     'class' => 'col s12 m6 l3',
                                 ],
                                 'pager'       => [
                                     'options'        => [
                                         'class' => 'pagination center-align',
                                     ],
                                     'nextPageLabel'  => '<i class="material-icons">chevron_right</i>',
                                     'prevPageLabel'  => '<i class="material-icons">chevron_left</i>',
                                     'maxButtonCount' => 5,
                                 ],
                             ]) ?>
        <?php Pjax::end() ?>

    </div>
</div>
