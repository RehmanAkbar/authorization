<?php

namespace Softpyramid\Authorization\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'name', 'label'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class,'role_user');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->orderBy('name');
    }
}
