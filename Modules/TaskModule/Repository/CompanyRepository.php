<?php

namespace Modules\TaskModule\Repository;


use Illuminate\Support\Facades\Storage;
use Modules\TaskModule\Entities\Company;

class CompanyRepository
{

    function findById($id)
    {
        return Company::find($id);
    }

    function findAllCompanys()
    {
        return Company::all();
    }
    function saveCompany($data)
    {
        return Company::create($data);
    }

    function updateCompanyData($Company,$data)
    {
      return $Company->update($data);
    }


    function deleteCompany($id)
    {
      $Company=Company::find($id);
        if($Company)
            Storage::disk('local')->delete($Company->image);
        return $Company->delete();
    }

}
