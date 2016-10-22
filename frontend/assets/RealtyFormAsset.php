<?php

    namespace frontend\assets;

    use yii\web\AssetBundle;

    class RealtyFormAsset extends AssetBundle{
        const API_KEY   = 'AIzaSyAUYPzaG4lQCw-v_7JUodo1mgWDlztuD0s';
        const LIBRARIES = 'places';

        public $css     = [
            'css/map-style.css'
        ];
        public $js      = [
            'https://maps.googleapis.com/maps/api/js?key='.self::API_KEY.'&libraries='.self::LIBRARIES,
            'js/realty-form.js',
            'js/form-map.js',
        ];
        public $depends = [
            'frontend\assets\SiteAsset',
        ];
    }