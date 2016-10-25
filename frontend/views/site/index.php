<?php
    
    /* @var $this yii\web\View
     * @var $dataProvider \yii\data\ActiveDataProvider
     * @var $searchModel  \common\models\search\RealtySearch
     */
    
    use yii\helpers\Url;
    use yii\widgets\ListView;
    use yii\widgets\Pjax;
    
    $this->title = 'My Yii Application';
    
    $script = <<<JS
$(document).ready(function(){
    		$('.parallax').parallax();
    		$('select').material_select();
    	});
JS;
    
    $this->registerJs($script, 3);
?>
<div class="parallax-container">
    <div class="parallax"><img src="<?= Url::to('/images/parallax1.jpg', true) ?>"></div>
    <div class="line line-bottom line-withBg">
        <div class="container">
            <div class="row no-margin">
                <div class="col s12 l8">
                    <h2 class="line-title white-text">Some Lead Header</h2>
                </div>
                <div class="col s12 l4 line-buttons">
                    <a href="<?= Url::to(['realty/create']) ?>" class="btn light-blue wave-effect waves-light truncate">
                        <i class="material-icons right">add</i>Add Adversting
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->render('../realty/filterRealty', ['searchModel' => $searchModel, 'action' => 'realty/index', 'showProperty' => true]) ?>
<div class="section">
    <div class="container">
        <?= ListView::widget([
                                 'dataProvider' => $dataProvider,
                                 'itemView'     => '../realty/_realtyItem',
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
    </div>
</div>