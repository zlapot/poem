<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "poems".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $title
 * @property string $poem
 * @property string $autor
 * @property integer $date
 * @property integer $censor
 */
class Poems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poems';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'title', 'poem', 'autor', 'date', 'censor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['id_user', 'date', 'censor'], 'integer'],
            [['poem'], 'string'],
            [['title', 'autor'], 'string', 'max' => 100],
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

    public static function cutStr($str, $count)
    {
        $str = strip_tags($str);
        $str = substr($str, 0, $count);
        $str = rtrim($str, "!,.-");
        $str = substr($str, 0, strrpos($str, ' '));
        return $str."… ";
    } 

      

}
