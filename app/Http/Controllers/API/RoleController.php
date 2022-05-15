<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Repositories\Admin\Role\RoleRepository;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RoleRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Response;
class RoleController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index(RoleRequest $request)
    {
        $collection = $this->repository->retrieveData($request->all());

        return RoleResource::collection($collection);
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));

        return (new RoleResource($role))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permissions'));
        return new RoleResource($role);
    }

    public function destory(Role $role)
    {
        if ($role->users()->count() > 0) {
            throw new GeneralException('Role has users, Cant delete it.');
        }
        else
        {
            //Detach all associated roles
            $role->permissions()->sync([]);

            $role->delete();
            return response()->noContent();
        }

    }

}