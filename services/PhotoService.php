<?php

namespace app\services;

use app\entities\Photo;
use app\models\UploadForm;
use app\repositories\PhotoRepository;
use Yii;
use yii\imagine\Image;

class PhotoService
{
    private PhotoRepository $repository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->repository = $photoRepository;
    }

    public function addPhotos(UploadForm $uploadForm)
    {
        foreach ($uploadForm->imageFiles as $file) {
            $photo = Photo::create($file);

            $image = \Yii::getAlias('@web') . 'uploads/' . $photo->name;
            $imageThumb = \Yii::getAlias('@web') . 'uploads/thumb/' . $photo->name;

            $this->repository->save($photo);

            $file->saveAs($image);

            Image::thumbnail($image, 100, 100)
                ->save($imageThumb, ['quality' => 80]);

        }
    }

    public function removePhoto($id): void
    {
        $photo = $this->repository->get($id);
        $photo->removePhoto($id);
        $this->repository->save($photo);
    }

}