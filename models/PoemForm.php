<?php

namespace app\models;

use Yii;

class PoemForm extends \yii\base\Model
{
    public $title;
    public $autor;
    public $poem;
    public $censor = false;
    public $status = false;

    public function rules()
    {
        return [
            [['title', 'poem', 'autor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['poem'], 'string'],
            [['title', 'autor'], 'string', 'max' => 100],
            ['censor', 'safe'],
            ['status', 'safe'],
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
            'title' => Yii::t('common/title','Название'),
            'poem' => Yii::t('common','Стих'),
            'autor' => Yii::t('common/main','Автор'),
            'date' => 'Дата публикации',
            'censor' => Yii::t('common/title', 'Наличие нецензурной лексики'),
        ];
    }

    public function add()
    {
        $poem = new Poems();
        $poem->id_user = Yii::$app->user->id;;
        $poem->title = $this->title;
        $poem->poem = $this->poem;
        $poem->autor = $this->autor;
        $poem->date = date('d.m.Y H:m');
        $poem->censor = $this->censor;
        $poem->isDelete = 0;
        $poem->status = $this->status;

        if(Yii::$app->user->can('admin') || Yii::$app->user->can('moderator'))
            $poem->status = 1;

        $poem->save(false);
        return $poem ? $poem : null;
    } 

    public function edit($id)
    {
        $poem = new Poems::find($id);
        $poem->title = $this->title;
        $poem->poem = $this->poem;
        $poem->autor = $this->autor;
        $poem->censor = $this->censor;
        $poem->isDelete = 0;
        $poem->status = $this->status;

        $poem->save(false);
        return $poem ? $poem : null;
    } 

    public function publ($id)
    {
        $poem = new Poems::find($id);
        $poem->status = $this->status;

        $poem->save(false);
        return $poem ? $poem : null;
    } 

    public static function del($id)
    {
        $post = Poems::find($id);
        $post->isDelete = 1;

        $post->save(false);
        return $post ? $post : null;
    }

}
