<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $guarded = ['id'];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}
