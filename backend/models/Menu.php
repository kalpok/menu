<?php
namespace modules\menu\backend\models;

use extensions\i18n\validators\FarsiCharactersValidator;

class Menu extends \modules\menu\common\models\Menu
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior',
            ]
        );
    }

    public function rules()
    {
        return [
            ['title', 'required'],
            ['title', 'trim'],
            ['isActive', 'integer'],
            ['language', 'default', 'value' => null],
            ['title', 'string', 'max' => 255],
            [['title'], FarsiCharactersValidator::className()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'title' => 'عنوان',
            'isActive' => 'نمایش در سایت',
            'language' => 'زبان',
            'createdAt' => 'تاریخ ساخت',
            'updatedAt' => 'آخرین بروزرسانی',
        ];
    }
}
