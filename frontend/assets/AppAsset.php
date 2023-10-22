<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'css/site.css',
		'css/style.css',
		'css/font-awesome.min.css',
        'css/slicknav.min.css',
        'css/hover.min.css',
        'css/responsive.css',
        'css/reset.css',
        'css/blue.css',
        'css/magnific-popup.css',
        'css/slick.css',
    ];
    public $js = [
	'css/active.js',
    'css/gmap.js',
    'css/isotope.pkgd.min.js',
    'css/jquery.appear.js',
    'css/jquery.counterup.min.js',
    'css/jquery.nav.js',
    'css/jquery.scrollUp.min.js',
    'css/jquery.slicknav.min.js',
    'css/magnific-popup.min.js',
    'css/masonry.pkgd.min.js',
    'css/mixitup.min.js',
    'css/modernizr.min.js',
    'css/particle-app.js',
    'css/particles.min.js',
    'css/slick.min.js',
    'css/typed.min.js',
    'css/waypoints.min.js',
    'css/wow.min.js',
    'css/ytplayer.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
