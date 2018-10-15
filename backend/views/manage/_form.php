<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use theme\widgets\Panel;
use theme\widgets\Button;
use extensions\i18n\widgets\LanguageSelect;
?>

<div class="menu-form">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات منو'
            ]) ?>
                <?=
                    $form->field($model, 'title')
                        ->textInput(
                            [
                                'maxlength' => 255,
                                'class' => 'form-control input-medium'
                            ]
                        )
                ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => ['index'],
                    ])
                ?>
            <?php Panel::end() ?>
            <?php if (Yii::$app->i18n->isMultiLanguage()) : ?>
                <?php Panel::begin([
                    'title' => 'زبان'
                ]) ?>
                    <?php if ($model->isNewRecord) : ?>
                        <?= $form->field($model, 'language')->widget(
                            LanguageSelect::className(),
                            ['options' => ['class' => 'form-control input-large']]
                        )->label(false); ?>
                    <?php else : ?>
                        <?= $form->field($model, 'language')->textInput([
                            'class' => 'form-control input-large',
                            'disabled' => true,
                            'value' => Yii::$app->formatter->asLanguage($model->language)
                        ])->label(false) ?>
                    <?php endif ?>
                <?php Panel::end() ?>
            <?php endif ?>
            <?php Panel::begin([
                'title' => 'ویژگی های منو'
            ]) ?>
                <?= $form->field($model, 'isActive')->checkbox(); ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
