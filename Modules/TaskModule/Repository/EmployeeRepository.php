<?php

namespace Modules\TaskModule\Repository;


use Modules\TaskModule\Entities\Employee;

class EmployeeRepository
{

    function findById($id)
    {
        return Employee::find($id);
    }

    function findAllEmployees()
    {
        return Employee::all();
    }
    function saveEmployee($data)
    {
        return Employee::create($data);
    }

    function updateEmployeeData($Employee,$data)
    {
        return $Employee->update($data);
    }


    function deleteEmployee($id)
    {
        $Employee=Employee::find($id);
        if($Employee)
            return $Employee->delete();
    }

}
