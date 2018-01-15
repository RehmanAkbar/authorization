<?php
/**
 * Created by PhpStorm.
 * User: fakhar
 * Date: 13/12/2016
 * Time: 3:28 PM
 */

namespace Softpyramid\Authorization\Repositories;


use Softpyramid\Authorization\Models\UserType;

class UserTypeRepository extends Repository
{

    public function model()
    {
       return UserType::class;
    }


}