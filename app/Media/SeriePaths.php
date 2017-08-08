<?php

namespace CodeFlix\Media;


trait SeriePaths
{
    use VideoStorages;

    public function getThumbFolderStorageAttribute()
    {
        return "series/{$this->id}";
    }

    public function getThumbRelativeAttribute()
    {
        return "{$this->thumb_folder_storage}/{$this->thumb}";
    }

    public function getThumbPathAttribute()
    {
        return $this->getAbsolutePath($this->getStorage(),$this->thumb_relative);
    }

    public function getThumbSmallRelativeAttribute()
    {
        list($name,$extension) = explode('.',$this->thumb);
        return "{$this->thumb_folder_storage}/{$name}_small.{$extension}";
    }

    public function getThumbSmallPathAttribute()
    {
        return $this->getAbsolutePath($this->getStorage(),$this->thumb_small_relative);
    }
}