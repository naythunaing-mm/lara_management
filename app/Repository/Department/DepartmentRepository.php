<?php 
namespace App\Repository\Department;
use App\Utility;
use App\Constant;
use App\ReturnMessages;
use App\Models\Department;
use App\Repository\Department\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface {
    public function departmentStore($paraData) {
        $returnObj = array();
        $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
        try {
            $paraObj             = new Department();
            $paraObj->department = $paraData['department'];
            $tempObj             = Utility::addCreated($paraObj);
            $tempObj->save();
            $returnObj['LaraHR'] = ReturnMessages::OK;
            return $returnObj;
        } catch(\Exception $e) {
            $returnObj['LaraHR'] = ReturnMessages::INTERNAL_SERVER_ERROR;
            return $returnObj;
        }
    }

    public function getDepartments() {
        $departments = Department::SELECT("id","department")
                       ->whereNULL("deleted_at")
                       ->orderBy("id","asc")
                       ->paginate(Constant::PAGE_LIMIT);
        return $departments;
    }

    public function editForm($id) {
        $departments = Department::find($id);
        return $departments;
    }

}