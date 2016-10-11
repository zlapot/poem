<?php

namespace app\models;

use Yii;

class PoemForm extends \yii\base\Model
{
    public $title;
    public $autor;
    public $poem;
    public $censor = false;

    public function rules()
    {
        return [
            [['title', 'poem', 'autor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['poem'], 'string'],
            [['title', 'autor'], 'string', 'max' => 100],
            ['censor', 'safe'],
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
            'title' => 'Название',
            'poem' => 'Стихотворение',
            'autor' => 'Автор',
            'date' => 'Дата публикации',
            'censor' => 'Наличие нецензурной лексики',
        ];
    }

    public function add()
    {
        $poem = new Poems();
        $poem->id_user = 1;
        $poem->title = $this->title;
        $poem->poem = $this->poem;
        $poem->autor = $this->autor;
        $poem->date = date('d.m.Y H:m');
        $poem->censor = $this->censor;

        $poem->save(false);
        return $poem ? $poem : null;
    } 

}
