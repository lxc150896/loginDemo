<?php

namespace App\Repositories\Eloquents;

use App\Model\Group;
use App\Repositories\Contracts\GroupRepository;

class GroupEloquentRepository extends AbstractEloquentRepository implements GroupRepository
{
    public function getModel()
    {
        return \App\Model\Group::class;
    }

    public function find($id)
    {
        return $this->_model
        ->find($id);
    }
}
