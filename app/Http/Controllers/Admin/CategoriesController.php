<?php

namespace CodeFlix\Http\Controllers\Admin;

use CodeFlix\Forms\CategoryForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Http\Requests\CategoryCRUDRequest;
use CodeFlix\Models\Category;
use CodeFlix\Repositories\CategoryRepository;
use CodeFlix\Validators\CategoryValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


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
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $categories = $this->repository->paginate();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $categories,
            ]);
        }

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.store'),
            'method' => 'POST'
        ]);

        return view('admin.categories.create',compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCRUDRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCRUDRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if(!$request->wantsJson()) {
                /** @var Form $form */
                $form = \FormBuilder::create(CategoryForm::class);

                if(!$form->isValid()){
                    return redirect()
                        ->back()
                        ->withErrors($form->getErrors())
                        ->withInput();
                }
            }

            $category = $this->repository->create($request->all());

            $response = [
                'message' => 'Categoria Criada com sucesso.',
                'data'    => $category->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('admin.categories.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $category,
            ]);
        }

        return view('admin.categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     *
     */
    public function edit(Category $category)
    {
        $form = \FormBuilder::create(CategoryForm::class, [
            'url' => route('admin.categories.update', ['user' => $category->id]),
            'method' => 'PUT',
            'model' => $category
        ]);

        return view('admin.categories.edit',compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(CategoryCRUDRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            if(!$request->wantsJson()) {
                /** @var Form $form */
                $form = \FormBuilder::create(CategoryForm::class, [
                    'data' => ['id' => $id]
                ]);

                if(!$form->isValid()){
                    return redirect()
                        ->back()
                        ->withErrors($form->getErrors())
                        ->withInput();
                }
            }

            $category = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Categoria alterada com sucesso.',
                'data'    => $category->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->route('admin.categories.index')->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->route('admin.categories.index')->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryCRUDRequest $request, $id)
    {
        if(!$this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE)) {
            $deleted = false;
            $message = 'Sem permissão.';
        } else {
            $deleted = $this->repository->delete($id);
            $message = 'Categoria removida com sucesso.';
        }

        if (request()->wantsJson()) {
            return response()->json([
                'message' => $message,
                'deleted' => $deleted,
            ]);
        }

        return redirect()->route('admin.categories.index')->with('message', $message);
    }
}
