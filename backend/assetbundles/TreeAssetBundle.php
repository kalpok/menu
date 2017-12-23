<?php
namespace modules\menu\backend\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@modules/menu/backend/assets';
    public $css = [
        'menu.css',
        'jqTree/jqtree.css',
    ];
    public $js = [
        'menu.js',
        'jqTree/tree.jquery.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
