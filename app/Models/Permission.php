<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	protected $fillable = [
    	'name', 'display_name', 'description'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = str_slug($value,"-");
    }

    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = ucwords($value);
    }

    public function roles()
    {
    	return $this->belongsToMany(\App\Models\Role::class, 'permission_role');
    }

    public function users()
    {
    	return $this->belongsToMany(\App\Models\User::class, 'role_user');
    }
}
