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
<div class="menu-tree">
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

                <div id="tree1"></div>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
<?php
$js = <<<JS
$('#save-btn').on('click', function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('href'),
        type: 'POST',
        data: $('#tree1').tree('toJson'),
        contentType: 'application/json; charset=utf-8',
        success: function(msg) {
            // alert(msg);
        }
    });
});
$('#update-item-form').on('beforeSubmit', function(e) {
    $(this).parents('.panel').addClass('hidden');
    $('#tree1').tree(
        'updateNode',
        $('#tree1').tree('getNodeById', $(this).find('.id').val()),
        {
            url: $(this).find('.url').val(),
            name: $(this).find('.title').val(),
        }
    );
    $(this).trigger('reset');
    return false;
});
$('#link-item-form').on('beforeSubmit', function(e) {
    node = {
        url: $(this).find('.url').val(),
        name: $(this).find('.title').val(),
        type: 'link',
        id: Math.random().toString(36).substr(2, 5)
    };
    $('#tree1').tree('appendNode', node);
    $(this).trigger('reset');
    return false;
});
JS;

$this->registerJs($js);
?>
<?php $this->registerJs("
    $(function() {
        $('#tree1').bind(
            'tree.select',
            function(event) {
                form = $('#update-item-form');
                form.trigger('reset');
                if (event.node) {
                    form.parents('.panel').removeClass('hidden');
                    var node = event.node;
                    form.find('.id').val(node.id);
                    form.find('.title').val(node.name);
                    if(node.hasOwnProperty('url')){
                        form.find('.url').val(node.url).attr('disabled', false)
                            .parent('.form-group').removeClass('hidden');
                    }else{
                        form.find('.url').attr('disabled', 'true')
                            .parent('.form-group').addClass('hidden');
                    }
                }
                else {
                    form.parents('.panel').addClass('hidden')
                    form.trigger('reset');
                }
            }
        );
        $.getJSON(
            'get-json-tree',
            'id='+$('#save-btn').attr('data-menuid'),
            function(data) {
                $('#loading').addClass('hidden');
                $('#tree1').tree({
                    dragAndDrop: true,
                    data: data,
                    rtl: true
                });
            }
        );
    });
") ?>
