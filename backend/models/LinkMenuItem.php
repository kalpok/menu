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
            'url' => 'آدرس اینترنتی',
            'openInNewTab' => 'باز شدن در تب جدید',
        ];
    }

    public static function createItem($data)
    {
        $item = new self;
        $item->title = $data['name'];
        $item->url = $data['url'];
        $item->type = 'link';
        $item->openInNewTab = $data['ntab'];
        return $item;
    }

    public static function getFamilyTreeAttributes($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->title,
            'url' => $item->url,
            'ntab' => (bool) $item->openInNewTab,
            'type' => 'link',
        ];
    }
}
