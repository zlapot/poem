<?php

namespace app\models;

use Yii;


class HokkyForm extends \yii\base\Model
{    
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
            [['autor'], 'string', 'max' => 100],
            [['censor'], 'safe'],
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'hokky' => Yii::t('common', 'Хокку'),
            'autor' => Yii::t('common/main','Автор'),
            'date' => 'Дата публикации',
            'censor' => Yii::t('common/title', 'Наличие нецензурной лексики'),
        ];
    }

    public function add()
    {
        $hokky = new Hokkys();
        $hokky->id_user = Yii::$app->user->id;
        $hokky->hokky = $this->hokky;
        $hokky->autor = $this->autor;
        $hokky->date = date('d.m.Y H:m');
        $hokky->utime = date('U');
        $hokky->censor = $this->censor;
        $hokky->isDelete = 0;
        $hokky->status = 0;

        if(Yii::$app->user->can('admin') || Yii::$app->user->can('moderator'))
            $hokky->status = 1;

        $hokky->save(false);
        return $hokky ? $hokky : null;
    } 

    public static function del($id)
    {
        $post = Hokkys::find($id);
        $post->isDelete = 1;

        $post->save(false);
        return $post ? $post : null;
    }
}
