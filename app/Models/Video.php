<?php

namespace CodeFlix\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

}
