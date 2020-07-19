<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use app\models\TomTask;

use yii\db\mssql\PDO;

class TomProject extends ActiveRecord
{
    /**
     * @param tasks is used for storing task name when doing inner join query
     * @param project is used for storing project name when doing inner join query
     */
    public $task;
    public $project;

    public function getTomTasks() {
        return $this->hasMany(TomTask::className(), ['project_id' => 'id']);
    }  


    public static function tableName(){
        return 'tom_project';
    }

    public static function getProject($project_id){
        return TomProject::find()->where(['id' => $project_id])->one();
    }

    public static function getProjectName($project_id){
        return TomProject::find()->where(['id' => $project_id])->select(['name'])->one();
    }

    public static function getAllProjects(){
        return TomProject::find()->orderBy(['name' => SORT_ASC])->all();
    }

    public static function findProject($project_id){
        return TomProject::find()->where(['id' => $project_id])->one();
    }

    public static function getProjectInfo($project_id){
        $query = TomProject::find()->where(['tom_project.id' => $project_id])->innerJoinWith('tomTasks')->select(['tom_task.name AS task', 'tom_project.name AS project'])->all();

        return $query;
    }

    public static function getPercentageOfCompletion($project_id){
        $connection = Yii::$app->getDb();

        $command = $connection->createCommand("SELECT (CASE WHEN koncani > 0 THEN ((koncani * 100.0) / vsi) ELSE  0 END) AS percentage
                                                FROM (SELECT COUNT(t.id) AS vsi, (SELECT COUNT(DISTINCT r.task_id) AS koncani
                                                FROM tom_task t JOIN tom_report r ON t.id=r.task_id
                                                WHERE t.project_id = :project_id AND r.percent_done = 100 AND NOT EXISTS (SELECT 1 FROM tom_task t2 JOIN tom_report r2 ON    
                                                t2.id=r2.task_id
                                                WHERE r.task_id = r2.task_id AND r2.percent_done <> 100 AND         
                                                t2.project_id= t.project_id))
                                                FROM tom_task t 
                                                WHERE t.project_id = :project_id2) AS test;");
        
        $command->bindParam(':project_id', $project_id, PDO::PARAM_INT);
        $command->bindParam(':project_id2', $project_id, PDO::PARAM_INT);

        return $command->queryAll()[0];
    }
}