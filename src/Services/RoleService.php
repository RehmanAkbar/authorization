<?php
/**
 * Created by PhpStorm.
 * User: fakhar
 * Date: 13/12/2016
 * Time: 3:27 PM
 */

namespace Softpyramid\Authorization\Services;


use Softpyramid\Authorization\Repositories\RoleRepository;

class RoleService extends ServiceAbstract
{

    protected $repository;

    protected $rules = [];

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function attachPermissions($role , $permissions){

        $role->permissions()->sync($permissions);

    }

}