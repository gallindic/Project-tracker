<?php

namespace app\helpers;

use Yii;

use app\models\TomReport;
use app\models\TomTask;
use app\models\TomProject;

class GlobalHelper{
    
    public static function getTaskResports($task_id){
        return TomReport::getTaskReports($task_id);
    }

    public static function getTasksCount($project_id){
        return TomTask::getTasksCount($project_id);
    }

    public static function getCompletedTasks($project_id){
        return (int) TomTask::getTaskCompletion($project_id)['count'];
    }

    public static function getUnfinishedTasks($project_id){
        return self::getTasksCount($project_id) - (int) self::getCompletedTasks($project_id);
    }

    public static function isTaskComplete($task_id){
        return TomTask::isTaskComplete($task_id);
    }

    public static function getProjectId($task_id){
        return (TomTask::getProjectId($task_id))['project_id'];
    }

    public static function getProjectPercentage($project_id){
        return (int)TomProject::getPercentageOfCompletion($project_id)['percentage'];
    }

    public static function getProjectName($project_id){
        return TomProject::getProjectName($project_id)['name'];
    }
}