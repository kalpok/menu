<?php
namespace modules\menu\backend\models;

use extensions\i18n\validators\FarsiCharactersValidator;

class LinkMenuItem extends Menu
{
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            ['title', 'trim'],
            ['url', 'url'],
            ['title', 'string', 'max' => 255],
            [['title'], FarsiCharactersValidator::className()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'url' => 'آدرس اینترنتی'
        ];
    }
}
