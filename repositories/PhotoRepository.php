<?php

namespace app\repositories;

use app\entities\Photo;

class PhotoRepository
{
    public function  get($id): Photo
    {
        if (!$photo = Photo::findOne($id)){
            throw new NotFoundException('Photo is not found.');
        }
        return $photo;
    }

    public function save(Photo $photo): void
    {
        if(!$photo->save()){
            throw new \RuntimeException('Saving error.');
        }
    }
}