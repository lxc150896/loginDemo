<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepository;

class UserServices
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function updateUser($request, $id)
    {
        try {
            $dataUser = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ];
            $this->userRepository->update($id, $dataUser);
            $dataId = [
                'id' => $id,
            ];
            $user = $this->userRepository->find($id);
            session()->flash('success', trans('user.success'));

            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
            ]);
        } catch (Exception $e) {
            Session::flash('unsuccess', trans('settings.unsuccess.error', ['messages' => $e->getMessage()]));

            return view('errors.error');
        }
    }

    public function deleteUser($id)
    {
        try {
            $this->userRepository->delete($id);
            session()->flash('success', trans('user.success'));

            return response()->json([
                'data' => '0',
            ]);
        } catch (Exception $e) {
            Session::flash('unsuccess', trans('settings.unsuccess.error', ['messages' => $e->getMessage()]));

            return view('errors.error');
        }
    }
}
