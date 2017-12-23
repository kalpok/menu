<?php
namespace modules\menu\frontend\widgets\simple;

use modules\menu\common\models\Menu;

class SimpleMenuWidget extends \yii\base\Widget
{
    public $menuId;
    public $showTitle;
    public $view = 'default';

    public function init()
    {
        parent::init();
        if (!isset($this->menuId)) {
            throw new \yii\base\InvalidConfigException(
                '`$menuId` property must be set.'
            );
        }
    }

    public function run()
    {
        $menu = Menu::findOne($this->menuId);
        if (null == $menu
            || !$menu->isRoot()
            || $menu->children(1)->count() == 0
        ) {
            return;
        }
        return $this->render(
            $this->view,
            [
                'menu' => $menu,
                'items' => $menu->children(1)->all(),
            ]
        );
    }
}
