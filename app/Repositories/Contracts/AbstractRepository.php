<?php

namespace App\Repositories\Contracts;

interface AbstractRepository
{
    public function getAll();

    public function update($id, $request);

    public function delete($id);

    public function create($request);
}
