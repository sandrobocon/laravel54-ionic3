<?php

namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;

trait ThumbUploads
{
    public function uploadThumb($id, UploadedFile $file)
    {
        $model = $this->find($id);
        $name = $this->upload($model,$file);
        if($name){
            $model->thumb = $name;
            $model->save();
        }
        return $model;
    }

    public function upload($model, UploadedFile $file)
    {
        /** @var FilesystemAdapter $storage */
        $storage = $model->getStorage();
        $name = md5(time()."{$model->id}-{$file->getClientOriginalName()}"). ".{$file->guessExtension()}";
        $result = $storage->putFileAs($model->thumb_folder_storage, $file,$name);
        return $result ? $name : $result;
    }
}