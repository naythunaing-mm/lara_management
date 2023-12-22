<?php

namespace App\Http\Controllers\Employee;

use App\Utility;
use App\ReturnMessages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\employeeRequest;
use App\Repository\Department\DepartmentRepositoryInterface;
use App\Repository\Employee\EmployeeRepository;
use App\Repository\Employee\EmployeeRepositoryInterface;
use PhpParser\Node\Stmt\Return_;

class employeeController extends Controller
{
    private $employeeRepository;
    private $departmentRepository;
    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        DepartmentRepositoryInterface $departmentRepository
    ) {
        DB::connection()->enableQueryLog();
        $this->employeeRepository = $employeeRepository;
        $this->departmentRepository = $departmentRepository;
    }
    public function employeeForm()
    {
        $departments = $this->departmentRepository->getDepartments();
        return view('layouts.Backend.Employee.employeeForm', compact(['departments']));
    }

    public function employeeStore(employeeRequest $request)
    {
        try {
            $result = $this->employeeRepository->employeeStore($request->all());
            $logs    = "Employee Insert Screen ::";
            Utility::saveLog($logs);
            if ($result['LaraManagement'] == ReturnMessages::OK) {
                return redirect('admin-backend/employee/employeeListing')->with('success_msg', 'Insert Data Successful.');
            } else {
                return redirect('admin-backend/employee/employeeListing')->with('error_msg', 'Insert Data Fail!');
            }
        } catch(\Exception $e) {
            $logs = "Employee Insert Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function employeeListing()
    {
        try {
            $employees = $this->employeeRepository->employeeListing();
            $logs      = "Employee Listing Screen :: ";
            Utility::saveLog($logs);
            return view('layouts.Backend.Employee.employeeListing', compact(['employees']));
        } catch(\Exception $e) {
            $logs = "Employee Listing Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function editForm($id)
    {
        try {
            $employee = $this->employeeRepository->employeeEdit($id);
            $departments = $this->departmentRepository->getDepartments();
            return view('layouts.Backend.Employee.employeeForm', compact(['employee','departments']));
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
        } catch(\Exception $e) {
            $logs = "Employee Update Error :: ";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function employeeDelete($id)
    {
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
        try {
            $employee = $this->employeeRepository->employeeDetail($id);
            $departments = $this->departmentRepository->getDepartments();
            return view('layouts.Backend.Employee.employeeDetail', compact(['employee','departments']));
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
