<?php
    use yii\alexposseda\fileManager\FileManager;

    /**
     * @var array $notSavedFiles
     * @var array $savedFiles
     */

?>
<div class="fmw-container card-panel" id="<?= $widgetId?>">
    <div class="card-title"><?= $title?></div>
    <div class="card-content fmw-content">
        <?php
            if(!empty($notSavedFiles)):
                ?>
                <div class="card-panel red lighten-3 fmw-notsaved">
                    <div class="card-title"><?= Yii::t('FileManagerWidget', 'Not Saved Files')?></div>
                    <div class="card-content">
                        <div class="row fmw-notsaved-gallery">
                            <?php foreach($notSavedFiles as $file): ?>
                                <div class="col l4 fmw-notsaved-item">
                                    <img src="<?= FileManager::getInstance()->getStorageUrl().$file ?>">
                                    <div class="fmw-actions">
                                        <button type="button" class="btn red fmw-removeBtn" data-path="<?= $file ?>">
                                            <i class="material-icons">remove</i>
                                        </button>
                                        <button type="button" class="btn fmw-replaceBtn" data-path="<?= $file ?>">
                                            <i class="material-icons">add</i>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php
            endif;
        ?>
        <div class="fmw-messageBox" id="<?= $widgetId?>-messageBox">
            <?php if(empty($savedFiles)): ?>
                <div class="fmw-message alert alert-info"><?= Yii::t('FileManagerWidget', 'Not found any file')?></div>
            <?php endif; ?>
        </div>
        <div class="fmw-galleryBox row" id="<?= $widgetId?>-galleryBox">
            <?php
                if(!empty($savedFiles)):
                    foreach($savedFiles as $file):
                        ?>
                        <div class="col l4 fmw-galleryBox-item">
                            <img src="<?= FileManager::getInstance()->getStorageUrl().$file?>">
                            <div class="fmw-actions">
                                <button type="button" class="btn btn-warning fmw-removeBtn" data-path="<?= $file?>">
                                    <i class="material-icons">remove</i>
                                </button>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
            ?>
        </div>
        <div class="fmw-preloader" id="<?= $widgetId?>-preloader">
            <span>Loading....</span>
        </div>
    </div>
    <div class="panel-footer">
        <div class="form-group fmw-input">
            <input type="file" name="<?= FileManager::getInstance()->getAttributeName()?>" class="form-control" id="<?= $widgetId?>-input" placeholder="<?= Yii::t('FileManagerWidget', 'Choose file')?>">

        </div>
    </div>
</div>
