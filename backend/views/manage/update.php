<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش منو';
$this->params['breadcrumbs'][] = ['label' => 'مدیریت منو ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="menu-update">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست منو ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
