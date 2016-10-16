<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "comments_anekdot".
 *
 * @property integer $id
 * @property integer $id_poem
 * @property integer $id_user
 * @property string $comment
 * @property string $date
 * @property integer $utime
 */
class CommentsAnekdot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments_anekdot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_poem', 'id_user', 'comment', 'date', 'utime'], 'required'],
            [['id_poem', 'id_user', 'utime'], 'integer'],
            [['comment'], 'string', 'max' => 100],
            [['date'], 'string', 'max' => 16],
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
            'utime' => 'Utime',
        ];
    }
}
