<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responses\ViewResponse;
use App\Models\Employee;
use App\Models\Company;
use App\Repositories\Admin\Employee\EmployeeRepository;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ManageEmployeeRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Http\Resources\EmployeeResource;
class EmployeeController extends Controller
{
    protected $repository;
    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
        // $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:employee-create', ['only' => ['create','store']]);
        // $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $collection = $this->repository->retrieveData($request->all());

        return EmployeeResource::collection($collection);
    }

    public function store(ManageEmployeeRequest $request)
    {
        $uploaded_profile_image = '';
        $backup='public/images/employee/profile';
        if(!is_dir($backup)) {
           Storage::makeDirectory($backup, 0755, true, true);
        }
                
        $file = $request->file('profile_image');
        if ($request->has('profile_image')) 
        {
            $profile_image = time().'_'.$file->getClientOriginalName();
            $upload = $file->storeAs($backup,$profile_image);    
            $uploaded_profile_image = 'images/employee/profile/'.$profile_image; 
        }

        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email ;
        $employee->profile_image = $uploaded_profile_image;
        $employee->telephone = $request->telephone;
        $employee->gender = $request->gender;
        $employee->save();

        return (new EmployeeResource($employee))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {   
        $uploaded_profile_image = '';
        $backup='public/images/employee/profile';
        if(!is_dir($backup)) {
           Storage::makeDirectory($backup, 0755, true, true);
        }
        if(isset($employee->profile_image))
        {
            Storage::disk('public')->delete($employee->profile_image);
        }           
        $file = $request->file('profile_image');
        if ($request->has('profile_image')) 
        {
            $profile_image = time().'_'.$file->getClientOriginalName();
            $upload = $file->storeAs($backup,$profile_image);    
            $uploaded_profile_image = 'images/employee/profile/'.$profile_image; 
        }

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->company_id = $request->company_id;
        $employee->email = $request->email ;
        $employee->profile_image = $uploaded_profile_image;
        $employee->telephone = $request->telephone;
        $employee->gender = $request->gender;
        $employee->save();
        return new EmployeeResource($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->noContent();
    }

    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

}