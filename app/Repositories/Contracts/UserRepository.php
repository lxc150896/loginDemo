<?php

namespace App\Repositories\Contracts;

use App\Model\User;

interface UserRepository extends AbstractRepository
{
    public function find($id);
}
