<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "poems".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $title
 * @property string $poem
 * @property string $autor
 * @property string $date
 * @property integer $censor
 */
class Poems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'title', 'poem', 'autor', 'date', 'created_at', 'isDelete', 'status', 'censor'], 'required'],
            [['id_user', 'created_at', 'isDelete', 'status', 'censor'], 'integer'],
            [['poem', 'date'], 'string'],
            [['title', 'autor'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'title' => 'Title',
            'poem' => 'Poem',
            'autor' => 'Autor',
            'date' => 'Date',
			'created_at' => 'Utime',
			'isDelete' => 'isDelete',
			'status' => 'Status',
            'censor' => 'Censor',
        ];
    }
}
