<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TaskForm extends Model
{
    public $name;
    public $project_id;

    public function rules()
    {
        return [
            [['name', 'project_id'], 'required'],
        ];
    }
}