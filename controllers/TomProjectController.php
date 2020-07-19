<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use app\models\TomProject;
use app\models\TomTask;
use app\models\TomReport;
use app\models\TaskForm;
use app\models\ReportForm;
use app\models\ProjectForm;
use yii\data\ActiveDataProvider;
use app\helpers\GlobalHelper;
use yii\helpers\VarDumper;

class TomProjectController extends Controller{

    public function createListViewForTasks($id){
        return new ActiveDataProvider([
            'query' => TomTask::getTasks($id),
        ]);
    }

    public function getProjectStatus($project_id){
        return (int) TomProject::getPercentageOfCompletion($project_id)["percentage"];
    }

    public function actionShow($project_id){
        $tasksData = self::createListViewForTasks($project_id);
        $project_info = TomProject::getProjectInfo($project_id);
        $percent_done = GlobalHelper::getProjectPercentage($project_id);

        $taskModel = new TaskForm();
        $reportModel = new ReportForm();
        
        return $this->render('show', ["tasksData" => $tasksData, 'project_info' => $project_info, 'project_id' => $project_id,
                                       'percent_done' => $percent_done, 'taskModel' => $taskModel, 'reportModel' => $reportModel]);
        
    }

    public function actionDelete($project_id){
        if(Yii::$app->request->post()){
            $project = TomProject::getProject($project_id);
            $tasks = TomTask::getProjectTasks($project_id);
            
            foreach($tasks as $task){
                $reports = TomReport::getTaskReports($task_id);

                foreach($reports as $report)
                    $report->delete();
                
                $task->delete();
            }

            $project->delete();

            $this->redirect(['site/index']);
        }
    }

    public function actionCreate(){
        $model = new ProjectForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $report = new TomProject();

            $report->id = $report::find()->max('id') + 1;
            $report->name = $model->name;
            $report->save();

            return $this->redirect(['show', 'project_id' => $report->id]);
        }
        else{
            return $this->render('create', ['model' => $model]);
        }
    }
}