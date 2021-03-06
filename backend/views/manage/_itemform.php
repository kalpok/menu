<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'options'=>[
        'id' => $formId,
        'enctype'=>'multipart/form-data'
    ]
]); ?>
<?=
    $form->field($menuItem, 'title')
        ->textInput(
            [
                'maxlength' => 255,
                'class' => 'form-control title'
            ]
        )
?>
<?=
    $form->field($menuItem, 'url')
        ->textInput(
            [
                'maxlength' => 255,
                'style' => 'direction:ltr',
                'class' => 'form-control url'
            ]
        )
?>
<?= $form->field($menuItem, 'openInNewTab')->checkbox(['class' => 'ntab']); ?>
<?php
    $btnLabel = ($scenario == 'update') ? 'بروزرسانی' : 'افزودن';
    $btnClass = ($scenario == 'update') ? 'btn-success' : 'btn-primary';
?>
<?=
    Html::submitButton(
        "<i class=\"fa fa-check\"></i> $btnLabel",
        ['class' => "btn $btnClass"]
    )
?>
<?php if ($scenario == 'update') : ?>
<?=
    Html::button(
        "<i class=\"fa fa-trash\"></i> حذف لینک",
        [
            'id' => 'remove-item',
            'class' => "btn btn-danger pull-left"
        ]
    )
?>
<?php endif ?>
<?= Html::hiddenInput('itemId', null, ['class' => 'id']) ?>
<?php ActiveForm::end();
