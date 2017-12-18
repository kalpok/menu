<?php
namespace modules\menu\backend\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@modules/menu/backend/assets/jqTree';
    public $css = [
        'jqtree.css',
    ];
    public $js = [
        'tree.jquery.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
