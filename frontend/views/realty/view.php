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
    'center' => [
        'lat' => $coord[0] * 1,
        'lng' => $coord[1] * 1,
    ],
    'zoom' => 14,
    'draggable' => false,
]);
$script = <<<JS
mapInit({$mapConfig});
setMarker({$marker});
$('.slick-slider').slick({
       adaptiveHeight: false,
       arrows: true,
       slidesToShow:2
      });
JS;
$this->registerJs($script, View::POS_END);
RealtyItemAsset::register($this);
$gallery = json_decode($model->gallery);
if (is_null($gallery)) $gallery = [];
?>
<div class="section">
    <div class="container">
        <h3><?= Yii::t('app', 'Street') . ': ' . $model->location->street ?></h3>
        <h4><?= Yii::t('app', 'Area') . ': ' . $model->area . 'm2' ?></h4>
        <h4><?= ucfirst(Yii::t('realty', 'Rooms')) . ': ' . $model->rooms_count ?></h4>
        <h4><?= ucfirst(Yii::t('realty', 'Floor')) . ': ' . $model->floor ?></h4>
        <div class="row">
            <div class="col s12 m8 l8 photo-map">
                <div class=" bordered">
                    <ul class="tabs">
                        <li class="tab"><a href="#gallery-wrap">Photo</a></li>
                        <li class="tab"><a href="#map-wrap">Map</a></li>
                    </ul>
                    <div class="gallery-wrap" id="gallery-wrap">
                        <div class="slick-container row">
                            <div class="slick-slider">
                                <?php foreach ($gallery as $photo):
                                    $image = $photo ? $photo : 'no_image.gif'
                                    ?>
                                    <div class="waves-effect waves-light">
                                        <img src="<?= FileManager::getInstance()
                                            ->getStorageUrl() . $image ?>">
                                    </div>
                                <?php endforeach; ?>
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
                        foreach ($contact as $k => $c):
                            if ($k == 'email') {
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
                <h4><?=Yii::t('app','Description')?></h4>
                <div class="bordered">
                    <?= $model->description ?>
                </div>
            </div>
        </div>
    </div>
</div>