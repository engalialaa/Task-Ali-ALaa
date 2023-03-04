<?php

namespace Modules\TaskModule\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\TaskModule\Datatables\CompanyDatatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TaskModule\Entities\Company;
use Modules\TaskModule\Repository\CompanyRepository;
use Modules\TaskModule\Http\Requests\CompanyRequest;
use PHPUnit\Exception;

class CompanyController extends Controller
{
    public function __construct(CompanyRepository $companyRepository)
  {
    $this->companyRepository =$companyRepository;
  }

    public function dashboard()
    {
        $companies = Company::get()->count();
        return view('taskmodule::dashboard',compact('companies'));
    }

    public function index(CompanyDatatable $companyDatatable)
    {
        return $companyDatatable->render('taskmodule::company.index');
    }

    public function create()
    {
        return view('taskmodule::company.create');
    }

    public function store(CompanyRequest $request)
    {


        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            //uploadImage
            if ($request->image){
                $imagePath = $request->image;
                $imageName = $imagePath->getClientOriginalName();

                $data['image'] = '/storage/'.$request->file('image')->storeAs('companies', $imageName, 'public');
            }

            $this->companyRepository->saveCompany($data);


            DB::commit();
            return redirect('companies')->with('success', 'success');
        }catch (Exception $exception){
            DB::rollBack();
            return redirect('companies')->with('success', 'success');
        }

    }
    public function edit($id)
    {
        $data =  $this->companyRepository->findById($id);
        return view('taskmodule::company.edit',compact('data'));
    }

    public function update(CompanyRequest $request, $id)
    {
      $data=$request->except('_method','_token');

      $company =  $this->companyRepository->findById($id);
        //uploadImage
        if ($request->image){
            Storage::disk('local')->delete($company->image);
            $imagePath = $request->image;
            $imageName = $imagePath->getClientOriginalName();

            $data['image'] = '/storage/'.$request->file('image')->storeAs('companies', $imageName, 'public');
        }

      $this->companyRepository->updateCompanyData($company,$data);

      return redirect('companies')->with('updated', 'updated');

        //
    }

    public function destroy($id)
    {
        $this->companyRepository->deleteCompany($id);

        return redirect('companies')->with('deleted', 'deleted');
    }
}
