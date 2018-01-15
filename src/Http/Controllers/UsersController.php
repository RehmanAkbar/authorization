<?php
/**
 * Created by Soft Pyramid.
 * User: fakhar
 */

namespace Softpyramid\Authorization\Controllers;

use Softpyramid\Authorization\Models\City;
use Softpyramid\Authorization\Models\Office;
use Softpyramid\Authorization\Models\Role;
use Softpyramid\Authorization\Models\UserType;
use Softpyramid\Authorization\Services\RoleService;
use App\Http\Requests;
use App\Http\Controllers\Controller as BaseController;

use Softpyramid\Authorization\Services\UserService;
use Softpyramid\Authorization\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class UsersController extends BaseController
{

    protected $service,$roleService;


    public function __construct(UserService $service,RoleService $roleService)
    {
        $this->service = $service;
        $this->roleService = $roleService;

        $roles   = Role::pluck('name', 'id')->toArray();
        $cities  = City::pluck('name', 'id')->toArray();
        $offices = Office::pluck('name', 'id')->toArray();
        $user_types = UserType::pluck('name', 'id')->toArray();

        view()->share('roles', $roles);
        view()->share('offices', $offices);
        view()->share('cities', $cities);
        view()->share('user_types', $user_types);

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


            $searchFields = 'name,email';

            $users = User::where(DB::raw('concat('.$searchFields.')') , 'LIKE' , '%'.$searchString.'%')->orderBy($field , $orderBy)->paginate($paginate);

        }else{

            $users = User::orderBy($field , $orderBy)->paginate($paginate);

        }

        if($orderBy == 'asc'){

            $orderBy = 'desc';

        }else{

            $orderBy = 'asc';
        }

        return view('users.index', compact('users','paginate','orderBy','field','searchString'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', ]);

        $this->service->createUser($request);

        return redirect(route('users.index'));
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
        $user = $this->service->find($id);
        return view('profile.index', compact('user'));
//        return view('users.show', compact('user'));
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
        $user = $this->service->find($id);

        return view('users.edit', compact('user'));
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
        $this->validate($request, ['name' => 'required', ]);

        $this->service->update($id,$request);
        return redirect(route('users.index'));
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

        return redirect(route('users.index'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));

    }

    public function changePassword(Request $request){


        $status = $this->service->changePassword();

        return redirect()->back();

    }

    public function lockScreen()
    {
        if(Auth::check()){

            \Session::put('locked', true);

            return view('auth.lock-screen');

        }

        return redirect()->route('home');
    }

    public function unLock()
    {
        if(!Auth::check()){

            return redirect('/login');
        }

        $password = Input::get('password');

        if(Hash::check($password,Auth::user()->password)){
            Session::forget('locked');
            return redirect('/home');
        }

        return redirect()->route('home');
    }

}
