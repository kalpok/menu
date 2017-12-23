<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;
use modules\menu\backend\assetbundles\TreeAssetBundle;

TreeAssetBundle::register($this);

$this->title = $root->title . ' - مدیریت لینک ها';
$this->params['breadcrumbs'][] = ['label' => 'مدیریت منو ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $root->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-tree-view">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست منو ها'],
            'save' => [
                'url' => ['save-json-tree', 'id' => $root->id],
                'label' => 'ذخیره تغییرات',
                'options' => [
                    'id' => 'save-btn',
                    'class' => 'pull-left',
                    'data-menuid' => $root->id
                ],
                'icon' => 'save',
                'type' => 'success'
            ]
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-5">
            <?php Panel::begin([
                'options' => ['class' => 'panel panel-default hidden'],
                'title' => 'بروزرسانی لینک'
            ]) ?>
                <?= $this->render('_itemform', [
                    'formId' => 'update-item-form',
                    'scenario' => 'update',
                    'menuItem' => $linkItem
                ]) ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'درج لینک جدید'
            ]) ?>
                <?= $this->render('_itemform', [
                    'formId' => 'link-item-form',
                    'scenario' => 'add',
                    'menuItem' => $linkItem
                ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'درخت لینک های منو'
            ]) ?>
                <div id="loading">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                    <span class="sr-only">Loading...</span>
                </div>
                <div id="menu-tree"></div>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
