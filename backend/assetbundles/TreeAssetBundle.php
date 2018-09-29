<?php
namespace modules\menu\backend\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@modules/menu/backend/assets';

    public $css = ['menu.css'];

    public $js = ['menu.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
