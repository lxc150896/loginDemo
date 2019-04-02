<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\UserServices;
use App\Repositories\Contracts\UserRepository;

class UserController extends Controller
{
	protected $userServices;
    protected $userRepository;

    public function __construct(UserServices $userServices, UserRepository $userRepository)
    {
        $this->userServices = $userServices;
        $this->userRepository = $userRepository;
    }

    public function postEditUser(LoginRequest $request, $id)
    {
        $this->userServices->updateUser($request, $id);

        return response([
            'result' => 'success'
        ], 200);
    }

    public function postDeleteUser($id)
    {
        $this->userServices->deleteUser($id);

        return response([
            'result' => 'success'
        ], 200);
    }

    public function postAddUser(LoginRequest $request)
    {
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        $this->userRepository->create($dataUser);

        return response([
            'result' => 'success'
        ], 200);
    }
}
