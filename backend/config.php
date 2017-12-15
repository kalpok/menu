<?php
return [
    'title' => 'ماژول مدیریت منو',
    'menu' => [
        'label' => 'مدیریت منو ها',
        'icon' => 'tree',
        'url' => ['/menu/manage/index'],
        'visible' =>  Yii::$app->user->can('menu.manage')
    ]
];
