<?php

namespace App\Repositories\Eloquents;

use App\Model\User;
use App\Repositories\Contracts\UserRepository;

class UserEloquentRepository extends AbstractEloquentRepository implements UserRepository
{
    public function model()
    {
        return new User;
    }

    public function getAll($data = [], $with = [], $dataSelect = ['*'])
    {
        return $this->model()
        ->select($dataSelect)
        ->where($data)
        ->get();
    }
}
