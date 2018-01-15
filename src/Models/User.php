<?php

namespace Softpyramid\Authorization\Models;

use App\Erp\Models\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable
{
    use Notifiable,HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type_id','city_id','office_id','image','gender','city','zip_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getImageAttribute()
    {
        $path = $this->uploads()->latest()->first();
        if($path){

            return Storage::cloud()->url($this->uploads()->latest()->first()->path);
        }

        return null;

    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    public function user_type() {

        return $this->belongsTo(UserType::class);

    }
    public function office(){

        return $this->belongsTo(Office::class);
    }

    public function getSlugAttribute() {

        try {
            return $this->user_type->slug;
        } catch (\Exception $e) {
            return '';
        }

    }

    public function getCompanyAttribute(){

        try {
            return $this->office->company;
        } catch (\Exception $e) {
            return '';
        }
    }
    public function updatePassword($password) {

        $user = auth()->user();
        $user->password = bcrypt($password);
        return $user->save();

    }

    public function roleIdsArray(){

        return $this->roles()->pluck('roles.id', 'roles.id')->toArray();
    }
    public function uploads() {
        return $this->morphMany(Upload::class, 'uploadable');
    }


}
