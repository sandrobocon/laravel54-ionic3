<?php

namespace CodeFlix\Repositories;

use CodeFlix\Media\ThumbUploads;
use CodeFlix\Models\Serie;
use CodeFlix\Validators\SerieValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SerieRepositoryEloquent
 * @package namespace CodeFlix\Repositories;
 */
class SerieRepositoryEloquent extends BaseRepository implements SerieRepository
{
    use ThumbUploads;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Serie::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
