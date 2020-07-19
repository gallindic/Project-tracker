<?php

namespace app\models;

use Yii;
use yii\helpers\VarDumper;
use yii\db\ActiveRecord;
use app\models\TomProject;
use app\models\TomReport;

use yii\db\mssql\PDO;

class TomTask extends ActiveRecord
{
    public function getTomProject() {
        return $this->hasOne(TomProject::className(), ['id' => 'project_id']);
    }

    public function getTomReports(){
        return $this->hasMany(TomReport::className(), ['task_id' => 'id']);
    }

    public static function tableName(){
        return 'tom_task';
    }

    public function getTask($task_id){
        return TomTask::find()->where(['id' => $task_id])->one();
    }

    public function getTasks($project_id){
        return TomTask::find()->where(['project_id' => $project_id]);
    }

    public function getProjectTasks($project_id){
        return TomTask::find()->where(['project_id' => $project_id])->all();
    }

    public function getTasksCount($project_id){
        return TomTask::find()->where(['project_id' => $project_id])->count();
    }

    public static function getTaskCompletion($project_id){
        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("
        SELECT COUNT(DISTINCT t.id)
        FROM tom_task t JOIN tom_report r ON t.id=r.task_id
        WHERE t.project_id = :project_id AND r.percent_done = 100 AND NOT EXISTS (SELECT 1 FROM tom_task t2 JOIN tom_report r2 ON t2.id=r2.task_id
        WHERE r.task_id = r2.task_id AND r2.percent_done <> 100 AND t2.project_id= t.project_id);");

        $command->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        return $command->queryAll()[0];
    }

    public static function isTaskComplete($task_id){
        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("SELECT DISTINCT 1
        FROM tom_task t JOIN tom_report r ON t.id=r.task_id
        WHERE t.id = :task_id AND r.percent_done = 100 AND NOT EXISTS (SELECT 1 FROM tom_task t2 JOIN tom_report r2 ON t2.id=r2.task_id
        WHERE r.task_id = r2.task_id AND r2.percent_done <> 100 AND t2.id= t.id);
        ");

        $command->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        return $command->queryAll()[0];
    }

    public static function getProjectId($task_id){
        return TomTask::find()->where(['id' => $task_id])->select(['project_id'])->one();
    }
}