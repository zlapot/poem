<?php

namespace app\models;

use yii\helpers\Html;
use Yii;

class Search extends \yii\base\Model
{
    public $search;
 
    public function Searching($value = '')
    {
        $pb_serch = Html::encode($value);
        $query = Poems::find()
            ->from(['poems'])
            ->where(['title' => $pb_serch]);

        return $query;
    }
}
