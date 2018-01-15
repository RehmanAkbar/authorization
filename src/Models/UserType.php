<?php

namespace Softpyramid\Authorization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserType extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'label',
        'theme_id',
        'is_admin_only',
        'role_id'
    ];

    protected $table = 'user_types';
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }
    

    public function users(){
        return $this->hasMany(User::class);
    }


}
