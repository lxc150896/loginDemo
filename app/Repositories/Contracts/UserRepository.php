<?php

namespace App\Repositories\Contracts;

use App\model\User;

interface UserRepository extends AbstractRepository
{
    public function model();

    public function getAll($data = [], $with = [], $dataSelect = ['*']);

    public function update($id, $request);

    public function delete($id);

    public function find($id);
}
