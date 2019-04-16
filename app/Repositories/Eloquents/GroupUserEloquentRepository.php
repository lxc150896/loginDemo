<?php

namespace App\Repositories\Eloquents;

use App\Model\GroupUser;
use App\Repositories\Contracts\GroupUserRepository;

class GroupUserEloquentRepository extends AbstractEloquentRepository implements GroupUserRepository
{
    public function getModel()
    {
        return \App\Model\GroupUser::class;
    }

    public function countUserGroup($groupId, $userId)
    {
        return $this->_model
        ->where([
            ['group_id', '=', $groupId],
            ['user_id', '=', $userId]
        ])
        ->first();
    }
}
