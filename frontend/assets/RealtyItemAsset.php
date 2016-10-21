<?php

    namespace frontend\assets;

    use yii\web\AssetBundle;

    class RealtyItemAsset extends AssetBundle{
        public $css     = [
            'css/realty_item.css',
            'css/slick.css',
            'css/slick-theme.css',
        ];
        public $js      = [
            '//maps.googleapis.com/maps/api/js?key=AIzaSyAUYPzaG4lQCw-v_7JUodo1mgWDlztuD0s',
            'js/map.js',
            'js/slick.js'
        ];
        public $depends = [
            'yii\web\JqueryAsset',
        ];
    }