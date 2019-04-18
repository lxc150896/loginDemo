<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id'];

    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'id', 'group_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
