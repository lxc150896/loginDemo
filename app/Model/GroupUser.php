<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $guarded = ['id'];
    protected $table = 'group_user';
}
