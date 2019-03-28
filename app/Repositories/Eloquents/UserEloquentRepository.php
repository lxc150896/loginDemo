<?php

namespace App\Repositories\Eloquents;

use App\Eloquent\User;
use App\Repositories\Contracts\UserInterface;

class UserEloquentRepository extends AbstractRepository implements UserInterface
{
    public function model()
    {
        return new User;
    }
}
