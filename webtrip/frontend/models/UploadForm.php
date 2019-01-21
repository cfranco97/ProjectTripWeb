<?php
namespace frontend\models;
use yii\base\Model;
use yii\web\UploadedFile;
class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [
                ['imageFile'], 'file',
                'skipOnEmpty' => false,
                'extensions' => 'jpg, gif, png, jpeg',
                'maxSize' => 1024*100,
            ],
        ];
    }

    public function upload($path)
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($path);//recebo o caminho que defini como parametro quando chamo este metodo
            return true;
        } else {
            return false;
        }
    }
}