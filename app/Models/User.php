<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        if (!empty($value))
            $this->attributes['password'] = bcrypt($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class, 'role_user');
    }

    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class, 'permission_role');
    }

    public function hasRole($role)
    {
        if(is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        
        return $this->roles->intersect($role)->count();
    }
}
