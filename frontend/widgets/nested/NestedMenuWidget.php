<?php
namespace modules\menu\frontend\widgets\nested;

use modules\menu\common\models\Menu;

class NestedMenuWidget extends \yii\base\Widget
{
    public $menuId;
    public $showTitle = false;
    public $useYiiMenuWidget = true;
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
        if ($this->useYiiMenuWidget) {
            return 'coming soon';
        } else {
            return $this->render($this->view, ['menu' => $menu]);
        }
    }
}
