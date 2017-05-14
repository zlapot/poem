<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;

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
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLE = 0;
    const DELETED_ON = 1;
    const DELETED_OFF = 0;

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

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
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

    public static function getAll($pageSize = 10)
    {
        $query = self::find()
            ->where(['status' => self::STATUS_ACTIVE, 'isDelete' => self::DELETED_OFF]);
                
        $pagination = new Pagination([
            'defaultPageSize' => $pageSize,
            'totalCount' => $query->count(),
        ]);

        $poems = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy([
                'id' => SORT_DESC,
            ])
            ->all();

        return $data = [
            'model' => $poems,
            'pagination' => $pagination,
        ];
    }

}
