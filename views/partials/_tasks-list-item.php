<?php
    use yii\helpers\Html;
    use app\helpers\GlobalHelper;
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\Url;
?>

<div class="task-list-item block-container <? if(GlobalHelper::isTaskComplete($model->id)) echo 'complete-list'; ?>">
    <div class="task-list-item-header">
        <?= Html::encode(Yii::t('app', $model->name)); ?>
        <div class="task-list-controls">
            <span class="delete-task-btn">
                <?php echo Html::a(FA::icon('trash'), ['tom-task/delete-task', 'task_id' => $model->id, 'project_id' => $model->project_id], [
                    'data' => [
                        'confirm' => Yii::t('app', 'Ali ste prepričani?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </span>
        </div>
    </div>
    <div class="task-list-item-body"  data-task-id="<?= $model->id ?>">
        <?php foreach((GlobalHelper::getTaskResports($model->id)) as $report): ?>
            <div class="task-report-item" data-task-id="<?= $model->id ?>" data-report-id="<?= $report->id ?>">
                <div class="report-info">
                    <div class="report-name">
                        <?= Html::encode(Yii::t('app', $report->name)); ?>
                    </div>
                    <div class="report-percentage">
                        <?= Html::encode(Yii::t('app', $report->percent_done)) ?> %
                    </div>
                    <div class="report-actions">
                        <span class="<?= ($report->percent_done) < 100 ? 'show-plus' : 'hide-plus' ?>">
                            <?php echo Html::a(FA::icon('plus'), ['tom-report/update', 'report_id' => $report->id, 'project_id' => $model->project_id], [
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </span>
                        <span class="delete-report-btn">
                            <?php echo Html::a(FA::icon('trash'), ['tom-report/delete', 'report_id' => $report->id, 'project_id' => $model->project_id], [
                                'data' => [
                                    'confirm' => Yii::t('app', 'Ali ste prepričani?'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </span>
                    </div>
                </div>
                <div class="progress report-progress" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: <?= $report->percent_done ?>%;" aria-valuenow="<?= $report->percent_done ?>" aria-valuemin="0" aria-valuemax="100" data-report-id="<?= $report->id ?>"></div>
                </div>
            </div>
        <?php endforeach; ?>
        <a class="open-report-modal-button openModalBtn" data-task-id="<?= $model->id ?>"><?= Yii::t('app', 'Dodaj poročilo'); ?></a>
    </div>
   
</div>
