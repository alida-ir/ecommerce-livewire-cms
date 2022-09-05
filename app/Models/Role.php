<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    const ROLE_USER_ID = 1;
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title' , 'label'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermissions($permission)
    {
        return $this->permissions()
                            ->where('title' , $permission)
                            ->exists();
    }
}
