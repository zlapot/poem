<?php

namespace app\models;

use Yii;

class CommentForm extends \yii\base\Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
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
            'comment' => 'Комментарий',
            'date' => 'Дата',
        ];
    }

    private function addComment($comment, $id)
    {
        $comment->id_user = 1;
        $comment->id_poem = $id;
        $comment->date = date('d.m.Y H:m');
        $comment->utime = date('U');
        $comment->comment = $this->comment;
        
        $comment->save(false);
        return $comment ? $comment : null;
    } 

    public function addToPoem($id)
    {
        $comment = new CommentsPoem();
        return $this->addComment($comment, $id);    
    }

    public function addToHokky($id)
    {
        $comment = new CommentsHokky();
        return $this->addComment($comment, $id);   
    }

    public function addToAnekdot($id)
    {
        $comment = new CommentsAnekdot();
        return $this->addComment($comment, $id);
    }

}
