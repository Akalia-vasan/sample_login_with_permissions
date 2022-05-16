<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\Company\CompanyRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CompanyTableController extends Controller
{
    protected $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

   
    public function invoke(Request $request)
    {
        return Datatables::make($this->repository->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['name', 'email', 'telephone'])
            ->addColumn('created_at', function ($company) {
                return Carbon::parse($company->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($company) {
                return Carbon::parse($company->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($company) {
                
                return '<a href="'.route('admin.auth.company.edit', $company).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a><a class="btn btn-secondary btn-sm" href="'.route('admin.auth.company.show', $company).'">
                    <i class="fa fa-eye" data-toggle="tooltip">
                    </i>
                    </a><a data-method="delete" href="'.route('admin.auth.company.destroy', $company).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                
            })
            ->make(true);
    }
}
