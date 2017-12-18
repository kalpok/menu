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

    public function attachTree($tree)
    {
        if (empty($tree)) {
            return;
        }
        foreach ($tree as $node) {
            $item = self::createItem($node);
            if (!$item->validate()) {
                $errors = $item->getFirstErrors();
                throw new \Exception(
                    "provided data contains validation errors: ".reset($errors)
                );
            }
            $item->appendTo($this);
            if (isset($node['children'])) {
                $item->attachTree($node['children']);
            }
        }
        return;
    }

    public function getFamilyTreeArray($currentTree = [])
    {
        $attributes = self::getFamilyTreeAttributes($this);
        if ($this->children(1)->count() !== 0) {
            $children = [];
            foreach ($this->children(1)->all() as $child) {
                $children[] = $child->getFamilyTreeArray();
            }
        }
        if (empty($attributes)) {
            return $children;
        }
        if (!empty($children)) {
            $attributes['children'] = $children;
        }
        return $attributes;
    }

    public static function getFamilyTreeAttributes($item)
    {
        switch ($item->type) {
            case 'link':
                return LinkMenuItem::getFamilyTreeAttributes($item);

            default:
                return [];
        }
    }

    private static function createItem($data)
    {
        if (!isset($data['type'])) {
            throw new \Exception(
                "invalid data array provided, type index must exist."
            );
        }
        switch ($data['type']) {
            case 'link':
                return LinkMenuItem::createItem($data);

            default:
                throw new \Exception(
                    "Unknown item type '{$data['type']}' detected."
                );
        }
    }

    public function removeChildren()
    {
        foreach ($this->children(1)->all() as $child) {
            $child->deleteWithChildren();
        }
    }
}
