<?php 
namespace App\Repository\Employee;

use App\Utility;
use App\Constant;
use App\Models\User;
use App\ReturnMessages;

class EmployeeRepository implements EmployeeRepositoryInterface {
    public function employeeStore($paraData) {
        $returnObj = array();
        $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj = new User();
            $paraObj->name        = $paraData['name'];
            $paraObj->email       = $paraData['email'];
            $paraObj->phone       = $paraData['phone'];
            $paraObj->nrc_number  = $paraData['nrc_number'];
            $paraObj->password    = $paraData['password'];
            $paraObj->birthday    = $paraData['birthday'];
            $paraObj->gender      = $paraData['gender'];
            $paraObj->address     = $paraData['address'];
            $paraObj->employee_id = $paraData['employee_id'];
            $paraObj->department_id = $paraData['department_id'];
            $paraObj->date_of_join  = $paraData['date_of_join'];
            $paraObj->status        = $paraData['status'];
            $tempObj                = Utility::addCreated($paraObj);
            $tempObj->save();
            $returnObj['LaraHR'] = ReturnMessages::OK;
            return  $returnObj;
        } catch(\Exception $e) {
            $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function employeeListing() {
        $Employee = User::SELECT("id","name","email","employee_id","department_id","nrc_number")
                    ->whereNULL("deleted_at")
                    ->orderBy("id","asc")
                    ->paginate(Constant::PAGE_LIMIT);
        return $Employee;
    }

    public function employeeEdit($id) {
        $employee = User::find($id);
        return $employee;
    }
} 