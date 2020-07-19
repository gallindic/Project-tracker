<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\TomTask;
use app\models\TomReport;
use app\models\TaskForm;
use yii\helpers\VarDumper;

class TomTaskController extends Controller
{
    public function actionCreate(){
        $model = new TaskForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
 
            $tomTask = new TomTask();
            $id = $tomTask::find()->max('id');

            $tomTask->id = $id + 1;
            $tomTask->project_id = $model->project_id;
            $tomTask->name = $model->name;
            $tomTask->start_date = date('Y-m-d 00:00:00');
            $tomTask->end_date = date('Y-m-d 00:00:00');
            $tomTask->save();

            $this->redirect(['tom-project/show', 'project_id' => $model->project_id]);
            
        }
    }

    public function actionDeleteTask($task_id, $project_id){
        if(Yii::$app->request->post()){
            $task = TomTask::getTask($task_id);
            $reports = TomReport::getTaskReports($task_id);

            foreach($reports as $report){
                $report->delete();
            }

            $task->delete();

            $this->redirect(['tom-project/show', 'project_id' => $project_id]);
        }
    }
}