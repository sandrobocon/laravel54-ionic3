<?php

namespace CodeFlix\Http\Controllers\Admin\Auth;

use CodeFlix\Forms\UserSettingsForm;
use CodeFlix\Http\Controllers\Controller;
use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserSettingsController extends Controller
{

    private $repository;

    /**
     * UserSettingsController constructor.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \CodeFlix\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $form = \FormBuilder::create(UserSettingsForm::class, [
            'url' => route('admin.user_settings.update'),
            'method' => 'PUT',
        ]);

        return view('admin.auth.setting',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @internal param User $user
     */
    public function update(Request $request)
    {
        /** @var Form $form */
        $form = \FormBuilder::create(UserSettingsForm::class);

        if(!$form->isValid()){
            return redirect()
                ->back()
                ->withErrors($form->getErrors())
                ->withInput();
        }

        $data = array_except($form->getFieldValues(), ['id','role']);
        $this->repository->update($data, \Auth::user()->id); // l5-repository
        return redirect()->route('admin.users.index')->with('message', 'Senha alterada com sucesso.');
    }


}
