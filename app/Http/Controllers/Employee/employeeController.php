<?php

namespace App\Http\Controllers\Employee;

use App\Utility;
use App\Models\User;
use App\ReturnMessages;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\Role\RoleRepository;
use App\Http\Requests\Employee\employeeRequest;
use App\Repository\Employee\EmployeeRepository;
use App\Repository\Role\RoleRepositoryInterface;
use App\Repository\Employee\EmployeeRepositoryInterface;
use App\Repository\Department\DepartmentRepositoryInterface;

class employeeController extends Controller
{
    private $employeeRepository;
    private $departmentRepository;
    private $roleRepository;
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository,
        RoleRepositoryInterface $roleRepository,
    ) {
        DB::connection()->enableQueryLog();
        $this->employeeRepository   = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
        $this->roleRepository       = $roleRepository;
    }
    public function employeeForm()
    {
        if (!Auth::guard('Admin')->user()->can('employee')) {
            abort(404);
        }
        $getMaxId = $this->employeeRepository->getMaxId();
        $registerId = $getMaxId + 1;
        $formattedRegisterId = 'LMS-' . str_pad($registerId, 8, '0', STR_PAD_LEFT);
        $departments = $this->departmentRepository->getDepartments();
        $roles       = $this->roleRepository->getRoles();
        return view('layouts.Backend.Employee.employeeForm', compact(['departments','roles','formattedRegisterId']));
    }

    public function employeeStore(employeeRequest $request)
    {
        if (!Auth::guard('Admin')->user()->can('employee_create')) {
            abort(404);
        }
        try {
            $result = $this->employeeRepository->employeeStore($request->all());
            $logs    = "Employee Insert Screen ::";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/employee/employeeListing')->with('success_msg', 'Insert Data Successful.');
            } else {
                return redirect('admin-backend/employee/employeeListing')->with('error_msg', 'Insert Data Fail!');
            }
        } catch (\Exception $e) {
            $logs = "Employee Insert Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function employeeListing()
    {
        if (!Auth::guard('Admin')->user()->can('employeeList_view')) {
            abort(404);
        }
        try {
            return view('layouts.Backend.Employee.employeeListing');
        } catch (\Exception $e) {
            abort(500);
        }
    }


    public function employeeDataTable()
    {
        try {
            $employees = $this->employeeRepository->employeeDataTable();
            if ($employees) {
                return $employees;
            } else {
                return abort(500);
            }
        } catch (\Exception $e) {
            abort(500);
        }

    }

    public function editForm($id)
    {
        if (!Auth::guard('Admin')->user()->can('employee_edit')) {
            abort(404);
        }
        try {
            $employee    = $this->employeeRepository->employeeEdit($id);
            $roles       = $this->roleRepository->getRoles();
            $departments = $this->departmentRepository->getDepartments();
            $oldRoles    = $employee->roles->pluck('id');
            return view('layouts.Backend.Employee.employeeForm', compact(['employee','departments','roles','oldRoles']));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function employeeUpdate(employeeRequest $request)
    {
        try {
            $result = $this->employeeRepository->getUpdate($request->all());
            $logs   = "Employee Update Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/employee/employeeListing')->with('success_msg', 'Update Data Successful.');
            } else {
                return redirect('admin-backend/employee/employeeListing')->with('error_msg', 'Update Data Fail!');
            }
        } catch (\Exception $e) {
            $logs = "Employee Update Error :: ";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function employeeDelete($id)
    {
        if (!Auth::guard('Admin')->user()->can('employee_delete')) {
            abort(404);
        }
        try {
            $result = $this->employeeRepository->getDelete($id);
            $logs   = "Employee Delete Screen :: ";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/employee/employeeListing')->with('success_msg', 'Data Delete Successful.');
            } else {
                return redirect('admin-backend/employee/employeeListing')->with('error_msg', 'Data Delete Fail!');
            }
        } catch (\Exception $e) {
            $logs = "Employee Delete Error :: ";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function employeeDetail($id)
    {
        if (!Auth::guard('Admin')->user()->can('employee_detail')) {
            abort(404);
        }
        try {
            $employee = $this->employeeRepository->employeeDetail($id);
            $departments = $this->departmentRepository->getDepartments();
            return view('layouts.Backend.Employee.employeeDetail', compact(['employee','departments']));
        } catch (\Exception $e) {
            abort(500);
        }
    }

}
