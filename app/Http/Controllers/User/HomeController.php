<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\LoginRequest;
use App\Repositories\Contracts\UserInterface;

class HomeController extends Controller
{
    protected $user;

    public function __construct(UserInterface $postCustomer)
    {
        $this->user = $user;
    }

    public function getHome()
    {
        $arrUser = $this->user->getAll();
        return view('user.home', compact('arrUser'));
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
        $this->user->create($request);
        return redirect('user.login');
    }

    public function getUpdateUser(LoginRequest $request, $id)
    {
        try {
            $this->user->update($id, $request);
        } catch (Exception $e) {
            Session::flash('unsuccess', trans('settings.unsuccess.error', ['messages' => $e->getMessage()]));

            return view('errors.error');
        }
    }

    public function getDeleteUser($id)
    {
        try {
            $this->user->delete($id);
        } catch (Exception $e) {
            Session::flash('unsuccess', trans('settings.unsuccess.error', ['messages' => $e->getMessage()]));

            return view('errors.error');
        }
    }
}
