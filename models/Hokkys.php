<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hokkys".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $title
 * @property string $hokky
 * @property string $autor
 * @property string $date
 * @property integer $utime
 * @property integer $censor
 */
class Hokkys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hokkys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'hokky', 'autor', 'date', 'utime', 'censor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['id_user', 'utime', 'censor'], 'integer'],
            [['hokky'], 'string'],
            [['title'], 'string', 'max' => 20],
            [['autor'], 'string', 'max' => 100],
            [['date'], 'string', 'max' => 16],
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
            'title' => 'Название',
            'hokky' => 'Хокку',
            'autor' => 'Автор',
            'date' => 'Дата публикации',
            'censor' => 'Наличие нецензурной лексики',
        ];
    }
}
