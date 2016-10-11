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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_poem', 'id_user', 'comment', 'date'], 'required'],
            [['id_poem', 'id_user', 'date'], 'integer'],
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
