<?php
/**
 * Created by PhpStorm.
 * User: fakhar
 * Date: 13/12/2016
 * Time: 3:27 PM
 */

namespace Softpyramid\Authorization\Services;


use Softpyramid\Authorization\Repositories\UserTypeRepository;

class UserTypeService extends ServiceAbstract
{

    protected $repository;

    protected $rules = [];

    public function __construct(UserTypeRepository $repository)
    {
        $this->repository = $repository;
    }


}