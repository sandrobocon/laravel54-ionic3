<?php

namespace CodeFlix\Media;


use Illuminate\Filesystem\FilesystemAdapter;

trait VideoStorages
{
    /**
     * @return \Illuminate\Filesystem\FilesystemAdapter
     */
    public function getStorage()
    {
        return \Storage::disk($this->getDiskDriver());
    }

    protected function getDiskDriver()
    {
        return config('filesystems.default');
    }

    protected function getAbsolutePath(FilesystemAdapter $storage, $fileRelativePath)
    {
        // "fullPath" + "serie/1/thumb.jpg (fileRelativePath)"
        return $storage->getDriver()->getAdapter()->applyPathPrefix($fileRelativePath);
    }
}