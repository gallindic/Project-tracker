<?php

    use yii\widgets\ListView;
    use yii\helpers\Html;

?>

<div class="tasks-container">
    <?= ListView::widget([
        'dataProvider' => $tasksData,
        'options' => [
            'tag' => 'div',
            'class' => 'tasks-list',
        ],
        'layout' => "{pager}\n{items}\n{pager}",
        'itemView' => '/partials/_tasks-list-item',
    ]);?>
</div>

<div class="custom-modal" id="formModal">
    <div class="modal-header">
        <h4><?= Yii::t('app', 'Dodaj poročilo'); ?></h4>
        <span id="modal-exit-btn">X</span>
    </div>
    <div class="modal-body">
        <?= $this->render('/tom-report/create', ['model' => $reportModel]); ?>
    </div>
</div>
