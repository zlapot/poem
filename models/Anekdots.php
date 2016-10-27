<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "anekdots".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $anekdot
 * @property string $autor
 * @property string $date
 * @property integer $utime
 * @property integer $censor
 */
class Anekdots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anekdots';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'anekdot', 'autor', 'date', 'utime', 'censor'], 'required', 
                'message'=>'Поле "{attribute}" не заполнено.'],
            [['id_user', 'utime', 'censor'], 'integer'],
            [['anekdot'], 'string'],
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
            'anekdot' => 'Анекдот',
            'autor' => 'Автор',
            'date' => 'Дата публикации',
            'censor' => 'Наличие нецензурной лексики',
        ];
    }
}
