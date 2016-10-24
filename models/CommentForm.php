<?php

namespace app\models;

use Yii;

class CommentForm extends \yii\base\Model
{
    public $comment;
    public $idpost;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'max' => 100],
            [['idpost'], 'safe'],
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
            'comment' => Yii::t('common/main', 'Комментарий'),
            'date' => 'Дата',
        ];
    }

    private function addComment($comment, $id)
    {
        $comment->id_user = Yii::$app->user->id;
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

    // 

    private function del($comment, $id)
    {     
            
        if($comment){
            $comment->delete(false);   
            return true; 
        }else{
            return false;
        }
    }

    public function delFromPoem($id)
    {
        $comment = CommentsPoem::findOne(['id' => $id, 'id_user' => Yii::$app->user->id]);
        return $this->del($comment, $id);
    }

    public function delFromHokky($id)
    {
        $comment = CommentsHokky::findOne(['id' => $id, 'id_user' => Yii::$app->user->id]);
        return $this->del($comment, $id);
    }

    public function delFromAnekdot($id)
    {
        $comment = CommentsAnekdot::findOne(['id' => $id, 'id_user' => Yii::$app->user->id]);
        return $this->del($comment, $id);
    }

}
