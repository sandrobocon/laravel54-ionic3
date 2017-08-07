<?php

namespace CodeFlix\Media;


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
}