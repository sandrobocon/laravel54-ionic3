<?php

namespace CodeFlix\Http\Controllers\api;

use CodeFlix\Repositories\UserRepository;
use Illuminate\Http\Request;
use CodeFlix\Http\Controllers\Controller;
use Laravel\Socialite\Two\User;

class RegisterUsersController extends Controller
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * RegisterUsersController constructor.
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        //pegar token
        $authorization = $request->header('Authorization');
        $accessToken = str_replace('Bearer ','',$authorization);

        //verificar o token no facebook
        $facebook = \Socialite::driver('facebook');
        /** @var User $userSocial */
        $userSocial = $facebook->userFromToken($accessToken);
        $user = $this->repository->findByField('email', $userSocial->email)->first();
        //criar usuario se não existe
        if(!$user){
            //registrar
            \CodeFlix\Models\User::unguard();
            $user = $this->repository->create([
                'name' => $userSocial->name,
                'email' => $userSocial->email,
                'role' => \CodeFlix\Models\User::ROLE_CLIENT,
                'verified' => true
            ]);
            \CodeFlix\Models\User::reguard();
        }
        //retornar o token
        return ['token' => \Auth::guard('api')->tokenById($user->id)];
    }
}
