<?php
/**
 * Created by PhpStorm.
 * User: fakhar
 * Date: 13/12/2016
 * Time: 3:27 PM
 */

namespace Softpyramid\Authorization\Services;


use Softpyramid\Authorization\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Models\Activity;

class UserService extends ServiceAbstract
{

    protected $repository;

    protected $rules = [];

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createUser($request){

        $this->repository->createUser($request);
    }

    public function update($id,$request){

        $user = $this->repository->updateUser($id,$request);

    }

    public function changePassword()
    {
        $check = Hash::check(request()->current_password, auth()->user()->password);

        if($check){

            $this->repository->updateUserPassword(request()->password);
            return true;
        }

        return false;
    }

}