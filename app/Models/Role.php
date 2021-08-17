<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = [
        'name',
        'slug',
    ];

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'permission_id')->withTimestamps();
    }

    public function hasPermission($permission_slug){
        $perms = $this->permissions()->where('slug',$permission_slug)->first();
        return isset($perms);
    }




}
