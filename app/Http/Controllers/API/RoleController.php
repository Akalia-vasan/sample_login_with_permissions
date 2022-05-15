<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Repositories\Admin\Role\RoleRepository;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RoleRequest;
class RoleController extends Controller
{
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(RoleRequest $request)
    {
        $collection = $this->repository->retrieveData($request->all());

        return RoleResource::collection($collection);
    }

}