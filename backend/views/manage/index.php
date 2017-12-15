<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'لیست منو ها';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sliders-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => ['label' => 'ساخت منو جدید'],
    ],
]); ?>
<?php Panel::begin([
    'title' => 'لیست منو ها'
]) ?>
<?php Pjax::begin([
    'id' => 'slider-gridviewpjax',
    'enablePushState' => false,
]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'core\grid\IDColumn'],
            ['class' => 'core\grid\LanguageColumn'],
            'title',
            'createdAt:date',
            'updatedAt:datetime',
            ['class' => 'core\grid\ActiveColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{tree} {update}',
                'buttons' => [
                    'tree' => function ($url, $model, $key) {
                        return Html::a(
                            '<span class="fa fa-tree"></span>',
                            $url,
                            ['title' => 'مدیریت لینک ها', 'data-pjax' => 0]
                        );
                    },
                ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<?php Panel::end() ?>
</div>
