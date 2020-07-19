<?php

namespace app\controllers;
use Yii;

use yii\web\Controller;
use app\models\TomReport;
use app\models\ReportForm;
use app\helpers\GlobalHelper;
use yii\helpers\VarDumper;

class TomReportController extends Controller
{
    public function actionCreate(){
        $model = new ReportForm();
            
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $tomReport = new TomReport();
            $id = $tomReport::find()->max('id') + 1;

            $tomReport->id = $id;
            $tomReport->task_id = $model->task_id;
            $tomReport->name = $model->name;
            $tomReport->percent_done = 0;
            $tomReport->save();

            $this->redirect(['tom-project/show', 'project_id' => GlobalHelper::getProjectId($model->task_id)]);
                
        }
   }

   public function actionDelete($report_id, $project_id){
        if(Yii::$app->request->post()){
            $report = TomReport::getReport($report_id);
            $report->delete();

            $this->redirect(['tom-project/show', 'project_id' => $project_id]);
        }
   }

   public function actionUpdate($report_id, $project_id){
        if(Yii::$app->request->post()){
            $report = TomReport::getReport($report_id);
            $report->percent_done = ($report->percent_done + 25) > 100 ? 100 : $report->percent_done + 25;
            $report->save();

            $this->redirect(['tom-project/show', 'project_id' => $project_id]);
        }
   }
}