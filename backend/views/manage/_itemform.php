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
                'class' => 'form-control input-xlarge title'
            ]
        )
?>
<?=
    $form->field($menuItem, 'url')
        ->textInput(
            [
                'maxlength' => 255,
                'style' => 'direction:ltr',
                'class' => 'form-control input-xlarge url'
            ]
        )
?>
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
<?= Html::hiddenInput('itemId', null, ['class' => 'id']) ?>
<?php ActiveForm::end();
