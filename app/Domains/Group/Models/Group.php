<?php

namespace App\Domains\Group\Models;

use App\Domains\Permission\Models\Permission;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name'];

    // Relationship with permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    // Relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}