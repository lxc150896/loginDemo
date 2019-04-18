<?php

namespace App\Repositories\Eloquents;

use App\Model\User;
use App\Repositories\Contracts\UserRepository;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepository
{
    public function getModel()
    {
        return \App\Model\User::class;
    }

    public function find($id)
    {
        return $this->_model
        ->find($id);
    }

    public function maxUser()
    {
        return $this->getAll()
        ->sortByDesc('id')
        ->first();
    }

    public function getUser($id)
    {
        return $this->_model
        ->where('id', '<>', $id)
        ->get();
    }

    public function getAvatar($id)
    {
        return $this->_model
        ->where('id', $id)
        ->first();
    }

    public function getUserGroup($id)
    {
        return $this->_model
        ->where('id', $id)
        ->with('groups')
        ->get();
    }

    public function searchUser($text)
    {
        return $this->_model
        ->where('name', 'like', "%$text%")
        ->get();
    }
}
