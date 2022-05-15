<?php

namespace App\Http\Controllers\Role;

use App\Http\Responses\ViewResponse;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Role\RoleRepository;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    
    protected $roleRepository;


    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','show']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        View::share('js', ['roles']);
    }


    
    public function index()
    {
        return new ViewResponse('admin.role.index');
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create')->withPermissions($permissions);
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));
    
        return redirect()->route('admin.auth.role.index')
                        ->with('success','Role created successfully');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit')
        ->withPermissions($permissions)
        ->withRole($role);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
    }

    public function show(Role $role)
    {
    }

    public function destory(Role $role)
    {
    }

}
