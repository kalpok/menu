<?php
namespace modules\menu\frontend\widgets\menu;

use modules\menu\common\models\Menu;

class MenuWidget extends \yii\base\Widget
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
                'menu' => $menu
            ]
        );
    }
}
