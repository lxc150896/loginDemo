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
        $user = $this->userRepository->find($request->id);
        session()->flash('success', 'admin.success');

        return response()->json($user);
    }

    public function postDeleteUser($id)
    {
        $this->userServices->deleteUser($id);
        session()->flash('success', 'success');
    }

    public function postAddUser(LoginRequest $request)
    {
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];
        $this->userRepository->create($dataUser);
        $maxUser = $this->userRepository->maxUser();
        session()->flash('success', 'success');

        return response()->json($maxUser);
    }

    public function getAvatar($id)
    {
        $avatar = $this->userRepository->getAvatar($id);
        return $avatar;
    }
}
