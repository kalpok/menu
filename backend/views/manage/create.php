<?php

use yii\helpers\Html;
use theme\widgets\ActionButtons;

$this->title = 'منو جدید';
$this->params['breadcrumbs'][] = ['label' => 'مدیریت منو ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست منو ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
