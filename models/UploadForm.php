<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;

    public function rules(): array
    {
        return [
            [['imageFiles'], 'image', 'maxFiles' => 5],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->imageFiles = UploadedFile::getInstances($this, 'imageFiles');
            return true;
        }
        return false;
    }
}