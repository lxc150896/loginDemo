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
}
