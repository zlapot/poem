<?php

namespace app\models;

use Yii;
use yii\data\Pagination;
use app\models\Poems;

class Search extends \yii\base\Model
{ 
    public $search;

    public function rules()
    {
        return [
            [['search'], 'required'],
            [['search'], 'string', 'max' => 255],
        ];
    }

	/**
	 * This method allow search poem in @see Poems
	 * 
	 * @param string $value This is searching value
	 * @param int $pageSize This is default page size for Pagination
	 * 
	 * @return Array $data ['model' => $1, 'pagination' => $2] $1 - Poems, $2 - pagination
	 */
    public function Searching($pageSize = 9)
    {        
        $query = Poems::find()
            ->where(['like', 'title', $this->search]);
            //->addParams( [':title' => $value]);

         $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count(),
        ]);
        
        $poems = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $data = [
        	'model' => $poems,
        	'pagination' => $pagination,
        ];
    }
}
