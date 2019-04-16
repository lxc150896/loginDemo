<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\MessageRequest;
use App\Services\UserServices;
use App\Repositories\Contracts\UserRepository;
use App\Model\User;

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
        $user = auth()->user();
        $check = $this->userRepository->find($id);
        if ($user->can('update', $check)) {
            $this->userServices->updateUser($request, $id);
            $user = $this->userRepository->find($request->id);
            session()->flash('success', 'admin.success');

            return response()->json($user);
        } else {
            return 'ok';
        }
    }

    public function postDeleteUser($id)
    {
        $user = auth()->user();
        $check = $this->userRepository->find($id);
        if ($user->can('delete', $check)) {
            $this->userServices->deleteUser($id);
            session()->flash('success', 'success');
        } else {
            return 'ok';
        }
    }

    public function postAddUser(LoginRequest $request)
    {
        $user = auth()->user();
        if ($user->can('create', User::class)) {
            $dataUser = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ];
            $this->userRepository->create($dataUser);
            $maxUser = $this->userRepository->maxUser();
            session()->flash('success', 'success');
            return response()->json($maxUser);
        } else {
            return 'ok';
        }
    }

    public function getAvatar($id)
    {
        $avatar = $this->userRepository->getAvatar($id);
        return $avatar;
    }

    public function searchUser(Request $request)
    {
        $user = $this->userRepository->searchUser($request->text);
        return response()->json($user);
    }
}
