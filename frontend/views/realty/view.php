<?php
    /**
     * @var $this    \yii\web\View
     * @var $model   \common\models\Realty
     * @var $contact \common\models\forms\ContactForm
     */
    use frontend\assets\RealtyItemAsset;
    use yii\alexposseda\fileManager\FileManager;
    use yii\web\View;

    $coord = explode(';', $model->location->coordinates);
    $marker = json_encode([
                              'position' => [
                                  'lat' => $coord[0] * 1,
                                  'lng' => $coord[1] * 1,
                              ],
                          ]);
    $mapConfig = json_encode([
                                 'center'    => [
                                     'lat' => $coord[0] * 1,
                                     'lng' => $coord[1] * 1,
                                 ],
                                 'zoom'      => 14,
                                 'draggable' => false,
                             ]);
    $script = <<<JS
mapInit({$mapConfig});
setMarker({$marker});
JS;
    $this->registerJs($script, View::POS_END);
    RealtyItemAsset::register($this);
    $gallery = json_decode($model->gallery);
?>
<div class="section">
    <div class="container">
        <h3><?= $model->location->street ?></h3>
        <h4>
            <?= $model->rooms_count ?> <?= Yii::t('realty', 'rooms') ?>, <?= $model->area ?>m2, <?= $model->floor ?> <?= Yii::t('realty',
                                                                                                                                'floor of') ?> <?= $model->floors_count ?>
        </h4>
        <div class="row">
            <div class="col s12 m8 l8">
                <div class=" bordered">
                    <ul class="tabs">
                        <li class="tab"><a href="#gallery-wrap">Photo</a></li>
                        <li class="tab"><a href="#map-wrap">Map</a></li>
                    </ul>
                    <div class="gallery-wrap" id="gallery-wrap">
                        <div class="slick-container row">
                            <div class="slick-nav col m12 l2 hide-on-small-only">
                                <?php
                                    foreach($gallery as $photo):
                                        ?>
                                        <div class="waves-effect waves-light">
                                            <img src="<?= FileManager::getInstance()
                                                                     ->getStorageUrl().$photo ?>">
                                        </div>
                                        <?php
                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="map-wrap" id="map-wrap">
                        <div class="map-container" id="map" style="height: 300px"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m4 l4">
                <h3 class="right-align"><?= $model->price ?>pln</h3>
                <div class="bordered">
                    <ul>
                        <?php
                            foreach($contact as $k => $c):
                                if($k == 'email'){
                                    continue;
                                }
                                ?>
                                <li>
                                    <span><?= Yii::t('app', ucfirst($k)) ?></span>
                                    <?= (!empty($c)) ? $c : ' not found' ?>
                                </li>
                            <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <div class="bordered">
                    <?= $model->description ?>
                </div>
            </div>
        </div>
    </div>
</div>