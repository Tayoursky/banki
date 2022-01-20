<?php

namespace app\helpers;

use yii\helpers\Inflector;
use yii\web\UploadedFile;

class PhotoHelper
{
    public static function formatName(UploadedFile $file): string
    {
        return Inflector::slug(mb_strtolower($file->baseName)) . '_' . time() . '.' . $file->extension;
    }
}