<?php


namespace Softpyramid\Authorization\Repositories;


use Softpyramid\Authorization\Models\Permission;

class PermissionRepository extends Repository
{
    protected $model;

    /**
     * PermissionRepository constructor.
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
    public function model()
    {
        return Permission::class;
    }
    /**
     * Fetch all records
     */
    /*public function all(){
        return $this->model->all();
    }*/

    /**
     * Return all records with roles
     * 
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function withRoles()
    {

        return $this->model->with('roles')->get();
    }

   /* public function find($id) {
        return $this->model->find($id);
    }

    public function update($request, $id) {

        $data = $request->all();
        $permission = $this->model->where('id' , $id)->first();
        $permission->update($data);
        return $permission;

    }

    public function create($permission_data) {

        $permission = $this->model->create($permission_data);

        return $permission;

    }*/
}