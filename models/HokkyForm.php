<?php

namespace app\models;

use Yii;


class HokkyForm extends \yii\base\Model
{
    public $title;
    public $autor;
    public $hokky;
    public $censor = false;
   
    public function rules()
    {
        return [
            [['hokky', 'autor', 'censor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['censor'], 'integer'],
            [['hokky'], 'string'],
            [['title'], 'string', 'max' => 20],
            [['autor'], 'string', 'max' => 100],
            [['censor'], 'safe'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'title' => 'Название',
            'hokky' => 'Хокку',
            'autor' => 'Автор',
            'date' => 'Дата публикации',
            'censor' => 'Наличие нецензурной лексики',
        ];
    }

    public function add()
    {
        $hokky = new Hokkys();
        $hokky->id_user = 1;
        $hokky->title = $this->title;
        $hokky->hokky = $this->hokky;
        $hokky->autor = $this->autor;
        $hokky->date = date('d.m.Y H:m');
        $hokky->utime = date('U');
        $hokky->censor = $this->censor;

        $hokky->save(false);
        return $hokky ? $hokky : null;
    } 
}
