<?php
namespace modules\menu\common\models;

use creocoder\nestedsets\NestedSetsBehavior;

class Menu extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'menu';
    }

    public function behaviors()
    {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
            ],
        ];
    }
}
