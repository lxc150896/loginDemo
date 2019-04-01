<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\UserServices;

class UserController extends Controller
{
	protected $userServices;

	public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function postEditUser(Request $request, $id)
    {
        return $this->userServices->updateUser($request, $id);
    }

    public function postDeleteUser($id)
    {
        $this->userServices->deleteUser($id);
    }
}
