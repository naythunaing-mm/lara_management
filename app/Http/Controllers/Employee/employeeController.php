<?php

namespace App\Http\Controllers\Employee;

use App\Utility;
use App\ReturnMessages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\employeeRequest;
use App\Repository\Employee\EmployeeRepository;
use App\Repository\Employee\EmployeeRepositoryInterface;

class employeeController extends Controller
{
    private $employeeRepository;
    public function __construct(EmployeeRepositoryInterface $employeeRepository) {
        DB::connection()->enableQueryLog();
        $this->employeeRepository = $employeeRepository;
    }
    public function employeeForm() {
        return view('layouts.Backend.Employee.employeeForm');
    }

    public function employeeStore(employeeRequest $request) {
        try {
            $result = $this->employeeRepository->employeeStore($request->all());
            $logs    = "Employee Insert Screen ::";
            Utility::saveLog($logs);
            if ($result['LaraHR'] == ReturnMessages::OK) {
                return redirect('admin-backend/employee/employeeListing')->with('success_msg','Insert Data Successful.');
            } else {
                return redirect('admin-backend/employee/employeeListing')->with('error_msg','Insert Data Fail!');
            }
        } catch(\Exception $e) {
            $logs = "Employee Insert Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function employeeListing() {
        try {
            $employees = $this->employeeRepository->employeeListing();
            $logs      = "Employee Listing Screen :: ";
            Utility::saveLog($logs);
            return view('layouts.Backend.Employee.employeeListing',compact(['employees']));
        } catch(\Exception $e) {
            $logs = "Employee Listing Error ::";
            $logs = $e->getMessage();
            abort(500);
        }
    }

    public function editForm($id) {
        try {
            $employee = $this->employeeRepository->employeeEdit($id);
            return view('layouts.Backend.Employee.employeeForm',compact(['employee']));
        } catch (\Exception $e) {
            abort(500);
        }
    }
}
