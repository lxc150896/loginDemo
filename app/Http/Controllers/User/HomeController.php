<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\LoginRequest;
use App\Repositories\Contracts\UserRepository;

class HomeController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getHome()
    {
        return view('user.home');
    }

    public function getUser()
    {
        $arrUser = $this->userRepository->getAll();
        return response()->json($arrUser);
    }
    
    public function getLogout()
    {
        Auth::logout();

        return view('user.login');
    }

    public function getRegisterUser()
    {
        return view('user.register');
    }

    public function postRegisterUser(LoginRequest $request)
    {
        $this->userRepository->create($request);
        return redirect('user.login');
    }
}
