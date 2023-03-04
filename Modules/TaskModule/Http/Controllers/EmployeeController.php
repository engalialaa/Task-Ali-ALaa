<?php

namespace Modules\TaskModule\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Mail;
use Modules\TaskModule\Datatables\EmployeeDatatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TaskModule\Emails\SendMail;
use Modules\TaskModule\Entities\Company;
use Modules\TaskModule\Entities\Employee;
use Modules\TaskModule\Repository\EmployeeRepository;
use Modules\TaskModule\Repository\CompanyRepository;
use Modules\TaskModule\Http\Requests\EmployeeRequest;
use PHPUnit\Exception;

class EmployeeController extends Controller
{
    public function __construct(EmployeeRepository $employeeRepository,CompanyRepository $companyRepository)
    {
        $this->employeeRepository =$employeeRepository;
        $this->companyRepository =$companyRepository;
    }

    public function index(EmployeeDatatable $employeeDatatable)
    {
        return $employeeDatatable->render('taskmodule::employee.index');
    }

    public function create()
    {
        $findAllCompanys = $this->companyRepository->findAllCompanys();
        return view('taskmodule::employee.create',compact('findAllCompanys'));
    }

    public function store(EmployeeRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except(['_token','password']);

            $data['password'] = bcrypt($request->password);

            //uploadImage
            if ($request->image){
                $imagePath = $request->image;
                $imageName = $imagePath->getClientOriginalName();

                $data['image'] = '/storage/'.$request->file('image')->storeAs('employees', $imageName, 'public');
            }

            $this->employeeRepository->saveEmployee($data);

            $meseeage = 'You have been added to the site successfully';

            $email = $data['email'];

            Mail::to($email)->send(new SendMail($meseeage));

            DB::commit();
            return redirect('employees')->with('success', 'success');
        }catch (Exception $exception){
            DB::rollBack();
            return redirect()->back();
        }

    }
    public function edit($id)
    {
        $data =  $this->employeeRepository->findById($id);
        $findAllCompanys = $this->companyRepository->findAllCompanys();
        return view('taskmodule::employee.edit',compact('data','findAllCompanys'));
    }

    public function update(EmployeeRequest $request, $id)
    {
        $data=$request->except('_method','_token');

        $company =  $this->employeeRepository->findById($id);

        $this->employeeRepository->updateEmployeeData($company,$data);

        return redirect('employees')->with('updated', 'updated');

        //
    }

    public function destroy($id)
    {
        $this->employeeRepository->deleteEmployee($id);
        return redirect('employees')->with('deleted', 'deleted');
    }
}
