<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $id_poem
 * @property integer $id_user
 * @property string $comment
 * @property integer $date
 */
class Comments extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'comments';
    }

    public function rules()
    {
        return [
            [['id_poem', 'id_user', 'comment', 'date', 'utime'], 'required'],
            [['id_poem', 'id_user', 'utime'], 'integer'],
            [['date'], 'string', 'max' => 16],
            [['comment'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_poem' => 'Id Poem',
            'id_user' => 'Id User',
            'comment' => 'Comment',
            'date' => 'Date',
        ];
    }
}
