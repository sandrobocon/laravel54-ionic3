<?php

namespace CodeFlix\Http\Controllers\Api;

use CodeFlix\Repositories\CategoryRepository;
use CodeFlix\Validators\CategoryValidator;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * @var CategoryValidator
     */
    protected $validator;

    public function __construct(CategoryRepository $repository, CategoryValidator $validator)
    {
        $this->middleware('api.auth');

        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index()
    {
        return $this->repository->all();
    }
}
