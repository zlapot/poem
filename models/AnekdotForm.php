<?php

namespace app\models;

use Yii;

class AnekdotForm extends \yii\base\Model
{
    public $autor;
    public $anekdot;
    public $censor = false;
    public $status = false;
    

    public function rules()
    {
        return [
            [['anekdot', 'autor','censor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['censor'], 'integer'],
            [['anekdot'], 'string'],
            [['autor'], 'string', 'max' => 100],
            [['censor'], 'safe'],
            [['status'], 'safe'],
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
            'anekdot' => Yii::t('common', 'Анекдот'),
            'autor' => Yii::t('common/main','Автор'),
            'date' => 'Дата публикации',
            'censor' => Yii::t('common/title', 'Наличие нецензурной лексики'),
        ];
    }

    public function add()
    {
        $anekdot = new Anekdots();
        $anekdot->id_user = Yii::$app->user->id;;
        $anekdot->anekdot = $this->anekdot;
        $anekdot->autor = $this->autor;
        $anekdot->date = date('d.m.Y H:m');
        $anekdot->censor = $this->censor;
        $anekdot->isDelete = 0;
        $anekdot->status = 0;

        if(Yii::$app->user->can('admin') || Yii::$app->user->can('moderator'))
            $anekdot->status = 1;

        $anekdot->save(false);
        return $anekdot ? $anekdot : null;
    }

    public function edit($id)
    {
        $anekdot = Anekdots::find($id);
        $anekdot->anekdot = $this->anekdot;
        $anekdot->autor = $this->autor;
        $anekdot->censor = $this->censor;
        $anekdot->isDelete = 0;
        $anekdot->status = $this->status;
      
        $anekdot->save(false);
        return $anekdot ? $anekdot : null;
    } 

    public function publ($id)
    {
        $anekdot = Anekdots::find($id);
        $anekdot->status = 1;

        $anekdot->save(false);
        return $anekdot ? $anekdot : null;
    }

    public static function del($id)
    {
        $post = Anekdots::find($id);
        $post->isDelete = 1;

        $post->save(false);
        return $post ? $post : null;
    }
}
