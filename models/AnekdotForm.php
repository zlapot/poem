<?php

namespace app\models;

use Yii;

class AnekdotForm extends \yii\base\Model
{
    public $autor;
    public $anekdot;
    public $censor = false;

    
    public function rules()
    {
        return [
            [['anekdot', 'autor','censor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['censor'], 'integer'],
            [['anekdot'], 'string'],
            [['autor'], 'string', 'max' => 100],
            [['censor'], 'safe'],
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
            'anekdot' => 'Анекдот',
            'autor' => 'Автор',
            'date' => 'Дата публикации',
            'censor' => 'Наличие нецензурной лексики',
        ];
    }

    public function add()
    {
        $anekdot = new Anekdots();
        $anekdot->id_user = 1;
        $anekdot->anekdot = $this->anekdot;
        $anekdot->autor = $this->autor;
        $anekdot->date = date('d.m.Y H:m');
        $anekdot->utime = date('U');
        $anekdot->censor = $this->censor;
        $anekdot->isDelete = 0;
        $anekdot->status = 0;

        if(Yii::$app->user->can('admin') || Yii::$app->user->can('moderator'))
            $anekdot->status = 1;

        $anekdot->save(false);
        return $anekdot ? $anekdot : null;
    } 
}
