<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\Employee\EmployeeRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class EmployeeTableController extends Controller
{
    protected $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

   
    public function invoke(Request $request)
    {
        return Datatables::make($this->repository->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['first_name', 'last_name', 'email'])
            ->addColumn('company', function ($employee) {
                return $employee->company->name;
            })
            ->addColumn('created_at', function ($employee) {
                return Carbon::parse($employee->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($employee) {
                return Carbon::parse($employee->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($employee) {
                
                return '<a href="'.route('admin.auth.employee.edit', $employee).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a><a class="btn btn-secondary btn-sm" href="'.route('admin.auth.employee.show', $employee).'">
                    <i class="fa fa-eye" data-toggle="tooltip">
                    </i>
                    </a><a data-method="delete" href="'.route('admin.auth.employee.destroy', $employee).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                
            })
            ->make(true);
    }
}
