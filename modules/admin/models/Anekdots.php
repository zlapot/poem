<?php

namespace app\modules\admin\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'anekdot', 'autor', 'date', 'utime', 'censor'], 'required'],
            [['id_user', 'utime', 'censor'], 'integer'],
            [['anekdot'], 'string'],
            [['autor'], 'string', 'max' => 100],
            [['date'], 'string', 'max' => 16],
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
            'anekdot' => 'Anekdot',
            'autor' => 'Autor',
            'date' => 'Date',
            'utime' => 'Utime',
            'censor' => 'Censor',
        ];
    }
}
