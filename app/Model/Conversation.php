<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = ['id'];
	
    public function groups()
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
