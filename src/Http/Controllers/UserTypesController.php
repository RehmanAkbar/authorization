<?php
/**
 * Created by Soft Pyramid.
 * User: fakhar
 */

namespace Softpyramid\Authorization\Controllers;

use Softpyramid\Authorization\Services\RoleService;
use App\Http\Requests;
use App\Http\Controllers\Controller as BaseController;

use Softpyramid\Authorization\Services\UserTypeService;
use Softpyramid\Authorization\Models\UserType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


class UserTypesController extends BaseController
{

    protected $service;


    public function __construct(UserTypeService $service,RoleService $roleService)
    {
        $this->service = $service;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orderBy = request()->query('orderBy', 'asc');
        $field = request()->query('field', 'name');
        $searchString = request()->query('string', null);
        $paginate = request()->query('paginate', 10);

        if($searchString){

            $searchFields = 'slug, name';
            $usertypes    = UserType::where(DB::raw('CONCAT('.$searchFields.')') , 'LIKE' , '%'.$searchString.'%')->orderBy($field , $orderBy)->paginate($paginate);
        }else{

            $usertypes = UserType::orderBy($field , $orderBy)->paginate($paginate);

        }

        if($orderBy == 'asc'){

            $orderBy = 'desc';

        }else{

            $orderBy = 'asc';
        }

        return view('usertypes.index', compact('usertypes','paginate','orderBy','field','searchString'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $usertype = $this->service->model();
        $roles = $this->roleService->all();
        $roles = $roles->pluck('name', 'id')->toArray();
        return view('usertypes.create',compact('usertype','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, ['slug' => 'required' ]);

        $this->service->create($request);

        if(request()->has('SAVE_AND_NEW') and request()->get('SAVE_AND_NEW')==1)
               return redirect(route('usertypes.create'));


        return redirect(route('usertypes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usertype = $this->service->find($id);
        return view('usertypes.show', compact('usertype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usertype = $this->service->find($id);
        $roles = $this->roleService->all();
        $roles = $roles->pluck('name', 'id')->toArray();
        return view('usertypes.edit', compact('usertype','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $this->validate($request, ['slug' => 'required' ]);

        $this->service->update($id,$request);
        return redirect(route('usertypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $status = $this->service->destroy($id);

        if(request()->ajax())
        {

            return response()->json([
                'success' => $status == 1 ? 'true' : 'false'
            ]);
        }

        return redirect(route('usertypes.index'));
    }

}
