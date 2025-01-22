<?php

namespace App\Domains\Permission\Models;

use App\Domains\Group\Models\Group;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

    // Relationship with groups
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    // Relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
