<?php 

use yii\helpers\Url;
use app\helpers\GlobalHelper;
use yii\helpers\VarDumper;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<h3><span class="project-info-name"><?= Html::encode(Yii::t('app', 'IME PROJEKTA:')); ?> </span><?= GlobalHelper::getProjectName($project_id) ?></h3>
<p><?= Yii::t('app', 'Vse naloge:') ?> <?= GlobalHelper::getTasksCount($project_id) ?></p>
<p><?= Yii::t('app', 'Končane naloge:') ?> <?= GlobalHelper::getCompletedTasks($project_id); ?></p>
<p><?= Yii::t('app', 'Naloge v izvajanju:') ?> <?= GlobalHelper::getUnfinishedTasks($project_id) ?></p>