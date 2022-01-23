<?php

namespace app\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public array $imageFiles = [];

    public function rules(): array
    {
        return [
            ['imageFiles', 'each', 'rule' => ['image']],
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