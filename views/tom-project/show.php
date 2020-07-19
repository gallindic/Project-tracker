<?php

/* @var $this yii\web\View */
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\VarDumper;
use app\helpers\GlobalHelper;
use yii\helpers\Url;

$this->title = 'Project tracker';
?>
<div class="site-index">
    <div class="body-content">

        <div class="row page-container">
            <div class="col-lg-4">
                <?= $this->render( '/partials/_sidebar' ); ?>
            </div>
            <div class="col-lg-4">
                <div class="progress-container block-container">
                    <p><?= Yii::t('app', 'Stanje projekta'); ?></p>
                    <div class="progress project-progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: <?= $percent_done ?>%;" aria-valuenow="<?= $percent_done ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h2 class="progress-stats"><?= $percent_done ?> %</h2>
                </div>
                <?= $this->render('/tom-task/show', ['tasksData' => $tasksData,  'reportModel' => $reportModel]); ?>
            </div>
            <div class="col-lg-4">
                <div class="project-info block-container">
                    <?= $this->render( '/partials/_projectInfo', ['project_info' => $project_info, 'project_id' => $project_id] ); ?>
                </div>
                <div class="add-task-container block-container">
                    <h5><?= Yii::t('app', 'Dodaj novo nalogo'); ?></h5>
                    <?= $this->render('/tom-task/create', ['model' => $taskModel, 'project_id' => $project_id]); ?>
                </div>
             </div>
        </div>
    </div>
</div>
