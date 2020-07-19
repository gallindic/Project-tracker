<?php
    use app\helpers\GlobalHelper;
    use yii\helpers\Html;
    use rmrevin\yii\fontawesome\FA;
?>
<div class="project-list block-container <?php if(GlobalHelper::getProjectPercentage($project->id) == 100) echo 'complete-list' ?>">
    <div class="project-list-header">
        <h3>
            <?php echo Html::a(Html::encode(Yii::t('app', $project->name)), ['tom-project/show', 'project_id' => $project->id], ['method' => 'post']) ?>
        </h3>
        <div class="project-list-controls">
            <span class="delete-project-btn">
                <?php echo Html::a(FA::icon('trash'), ['tom-project/delete', 'project_id' => $project->id], [
                    'data' => [
                        'confirm' => Yii::t('app', 'Ali ste prepričani?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </span>
        </div>
    </div>
    <div class="project-list-body">
        <div class="tasks">
            <?= Html::encode(Yii::t('app', 'Naloge: ')).GlobalHelper::getTasksCount($project->id) ?>
        </div>
        <div class="percentage">
            <div class="progress" style="height: 10px;">
                <div class="progress-bar" role="progressbar" style="width: <?= GlobalHelper::getProjectPercentage($project->id) ?>%;" aria-valuenow="<?= GlobalHelper::getProjectPercentage($project->id) ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>