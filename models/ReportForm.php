<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ReportForm extends Model
{
    public $name;
    public $task_id;

    public function rules()
    {
        return [
            [['name', 'task_id'], 'required'],
        ];
    }
}