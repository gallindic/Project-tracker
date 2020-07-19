<?php

namespace app\models;

use Yii;
use yii\base\Model;

class ProjectForm extends Model
{
    public $name;

    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }
}