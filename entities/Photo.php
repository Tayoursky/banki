<?php

namespace app\entities;

use app\helpers\PhotoHelper;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 *
 */

class Photo extends ActiveRecord
{
    public static function create(UploadedFile $file): self
    {
        $photo = new static();
        $photo->name = PhotoHelper::formatName($file);
        $photo->created_at = time();
        return $photo;
    }

    public static function tableName(): string
    {
        return '{{%photo}}';
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created'
        ];
    }
}