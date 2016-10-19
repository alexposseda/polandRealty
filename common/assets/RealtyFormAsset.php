<?php

    namespace common\assets;

    use yii\web\AssetBundle;

    class RealtyFormAsset extends AssetBundle{
        public $sourcePath = '@common/assets';

        public $js = [
            'js/realtyForm.js',
        ];

        public $depends = [
            'yii\bootstrap\BootstrapPluginAsset',
        ];
    }