<?php
    /**
     * @var $this  \yii\web\View
     * @var $model \common\models\Realty
     */
    use yii\alexposseda\fileManager\FileManager;
    use yii\helpers\Url;

?>

<a href="<?= Url::to(['/realty/view', 'id' => $model->id]) ?>">
    <div class="card adv adv-small hoverable">
        <div class="card-image">
            <img src="<?= FileManager::getInstance()
                                     ->getStorageUrl().json_decode($model->gallery)[0] ?>">
        </div>
        <div class="card-content">
            <p class="card-title"><?= $model->location->country->name.' '.$model->location->city.' '.$model->location->street ?></p>
            <p class="adv-price"><?= $model->price ?></p>
            <p class="adv-character"><?= $model->rooms_count ?> <?= Yii::t('realty', 'rooms') ?>, <?= $model->area ?>
                m2, <?= $model->floor ?> <?= Yii::t('realty', 'floor of') ?> <?= $model->floors_count ?></p>
        </div>
        <div class="card-action">
            <p class="realty-type"><?= $model->buildingType->title ?></p>
            <p class="adv-type"><?= $model->adType->title ?></p>
            <div class="clearfix"></div>
        </div>
    </div>
</a>
