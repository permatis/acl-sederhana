<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = [
    	'name', 'description'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function users()
    {
    	return $this->belongsToMany(\App\Models\User::class, 'role_user');
    }

    public function permissions()
    {
    	return $this->belongsToMany(\App\Models\Permission::class, 'permission_role');
    }
}
