<?php
namespace modules\menu\common\models;

class Menu extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'menu';
    }

    public function behaviors()
    {
        return [];
    }
}
