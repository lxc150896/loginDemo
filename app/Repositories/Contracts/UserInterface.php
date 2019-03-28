<?php

namespace App\Repositories\Contracts;

use App\Model\User;

interface UserInterface extends AsbtractRepositoryInterface
{
    public function getData($data = []);

    public function store($data = []);

    public function find($id);
}
