<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

use App\Http\Responses\ViewResponse;
use App\Models\Company;
use App\Repositories\Admin\Company\CompanyRepository;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ManageCompanyRequest;
use App\Http\Requests\CompanyUpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class CompanyController extends Controller
{


    protected $repository;


    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
        $this->middleware('permission:company-create', ['only' => ['create','store']]);
        $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:company-delete', ['only' => ['destroy']]);
        View::share('js', ['companies']);
    }

    public function index()
    {
        return new ViewResponse('admin.company.index');
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(ManageCompanyRequest $request)
    {
        $uploaded_cover_image = '';
        $uploaded_logo = '';
        $backupLogo='public/images/company/logo';
        if(!is_dir($backupLogo)) {
           Storage::makeDirectory($backupLogo, 0755, true, true);
        }       
        $logofile = $request->file('logo');
        if ($request->has('logo')) 
        {
            $logo_image = time().'_'.$logofile->getClientOriginalName();
            $upload_success1 = $logofile->storeAs($backupLogo,$logo_image);    
            $uploaded_logo = 'images/company/logo/'.$logo_image; 
        }

        $backup='public/images/company/cover';
        if(!is_dir($backup)) {
           Storage::makeDirectory($backup, 0755, true, true);
        }
                
        $coverfile = $request->file('cover_image');
        if ($request->has('cover_image')) 
        {
            $cover_image = time().'_'.$coverfile->getClientOriginalName();
            $upload = $coverfile->storeAs($backup,$cover_image);    
            $uploaded_cover_image = 'images/company/cover/'.$cover_image; 
        }

        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->telephone = $request->telephone;
        $company->logo =$uploaded_logo ;
        $company->cover_image = $uploaded_cover_image;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->created_by = auth()->user()->id;  
        $company->save();
        return redirect()->route('admin.auth.company.index')
                        ->with('success','Company created successfully');
    }

    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $uploaded_cover_image = '';
        $uploaded_logo = '';
        $backupLogo='public/images/company/logo';
        if(!is_dir($backupLogo)) {
           Storage::makeDirectory($backupLogo, 0755, true, true);
        }
        if(isset($company->logo))
        {
            // Storage::disk('public')->delete($company->logo);
        }       
        $logofile = $request->file('logo');
        if ($request->has('logo')) 
        {
            
            $logo_image = time().'_'.$logofile->getClientOriginalName();
            $upload_success1 = $logofile->storeAs($backupLogo,$logo_image);
            $uploaded_logo = 'images/company/logo/'.$logo_image; 
        }

        $backup='public/images/company/cover';
        if(!is_dir($backup)) {
           Storage::makeDirectory($backup, 0755, true, true);
        }
                
        $coverfile = $request->file('cover_image');
        if ($request->has('cover_image')) 
        {
            if(isset($company->cover_image))
            {
                // Storage::disk('public')->delete($company->cover_image);
            }
            $cover_image = time().'_'.$coverfile->getClientOriginalName();
            $upload = $coverfile->storeAs($backup,$cover_image);    
            $uploaded_cover_image = 'images/company/cover/'.$cover_image; 
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->telephone = $request->telephone;
        $company->logo =$uploaded_logo ;
        $company->cover_image = $uploaded_cover_image;
        $company->address = $request->address;
        $company->website = $request->website;
        $company->created_by = auth()->user()->id;  
        $company->save();

        
    
        return redirect()->route('admin.auth.company.index')
                        ->with('success','Company updated successfully');
    }

    public function destroy(Company $company)
    {
        if(isset($company->logo))
        {
            Storage::disk('public')->delete($company->logo);
        }
        if(isset($company->cover_image))
        {
            Storage::disk('public')->delete($company->cover_image);
        }
        $company->delete();
        return redirect()->route('admin.auth.company.index')
                        ->with('success','Company deleted successfully');
    }

    public function show(Company $company)
    {
        return view('admin.company.show')
        ->withCompany($company);
    }

}
