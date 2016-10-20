<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\User;
use yii\imagine\Image;
use Imagine\Image\Box;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $imageFile;
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 1],
        ];
    }

    
    public function upload()
    {
        if ($this->validate()) {            
            $file = $this->imageFile;
            $path = 'img/upload/' . Yii::$app->user->id . 'u.' . $file->extension;            
            //$file->saveAs($path);

            $imagine = Image::getImagine($file)
            ->open($file->tempName)
            ->thumbnail(new Box(120, 120))
            ->save($path, ['quality' => 90]);
           
            $_user = User::findIdentity(Yii::$app->user->id);
            $_user->img = $path;
            $_user->save(false);
                      
            return true;
        } else {
            return false;
        }
    }
}