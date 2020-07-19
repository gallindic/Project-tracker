<?php

namespace app\models;


use yii\db\ActiveRecord;
use app\models\TomTask;

class TomReport extends ActiveRecord
{

    public function getTomTask() 
    {
        return $this->hasOne(TomTask::className(), ['id' => 'task_id']);
    }  

    public static function tableName()
    {
        return 'tom_report';
    }

    public static function getTaskReports($task_id){
        return TomReport::find()->where(['task_id' => $task_id])->orderBy(['name' => SORT_ASC])->all();
    }

    public static function getReport($report_id){
        return TomReport::find()->where(['id' => $report_id])->one();
    }
}